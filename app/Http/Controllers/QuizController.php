<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelatihan;
use App\Models\HistoryUser;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Choice;
use Carbon\Carbon;

class QuizController extends Controller
{
    // Menampilkan soal dari database
    public function soal(Request $request, $quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $questions = Question::where('quiz_id', $quiz_id)->with('choices')->get();
        $user_id = Auth::id(); // Ambil ID user yang login

        // Ambil data attempt user
        $attempt = \DB::table('quiz_attempts')
            ->where('quiz_id', $quiz_id)
            ->where('user_id', $user_id)
            ->first();

        // Hitung passing score (misalnya minimal 70% benar)
        $passingScore = ceil($questions->count() * 0.7);

        // Jika user sudah mencapai passing score, redirect ke halaman hasil
        if ($attempt && $attempt->score >= $passingScore) {
            return redirect()->route('quiz.hasil', ['quiz_id' => $quiz_id])
                ->with('error', 'Anda sudah menyelesaikan quiz ini dengan skor yang cukup.');
        }

        if ($questions->isEmpty()) {
            return redirect()->route('home')->with('error', 'Tidak ada soal dalam kuis ini.');
        }

        $currentQuestionIndex = $request->query('question', 0);
        $currentQuestion = $questions[$currentQuestionIndex] ?? null;

        if (!$currentQuestion) {
            return redirect()->route('quiz.hasil', ['quiz_id' => $quiz_id]);
        }

        // Cek waktu quiz
        if (!session("quiz_start_time_$quiz_id")) {
            session(["quiz_start_time_$quiz_id" => now()]);
        }

        $elapsedTime = now()->diffInSeconds(session("quiz_start_time_$quiz_id"));
        $remainingTime = ($quiz->duration * 60) - $elapsedTime; // Konversi menit ke detik

        if ($remainingTime <= 0) {
            return redirect()->route('quiz.hasil', ['quiz_id' => $quiz_id]);
        }

        return view('quiz.soal', compact('quiz', 'questions', 'currentQuestion', 'currentQuestionIndex', 'remainingTime'));
    }


    // Menyimpan jawaban per soal
    public function submitAnswer(Request $request)
    {
        $quiz_id = $request->input('quiz_id');
        $currentQuestionIndex = (int) $request->input('current_question_index');
        $action = $request->input('action');
        $user_id = Auth::id();

        // Ambil jawaban dari session atau buat array kosong jika belum ada
        $answers = session("answers_$quiz_id", []);

        if ($request->has('answer')) {
            $answers[$currentQuestionIndex] = $request->input('answer');
            session(["answers_$quiz_id" => $answers]); // Pastikan session diperbarui
        }

        $totalQuestions = Question::where('quiz_id', $quiz_id)->count();

        // Jika tombol "Selesai" ditekan atau ini adalah soal terakhir
        if ($action === 'finish' || $currentQuestionIndex >= $totalQuestions - 1) {
            // Hitung skor
            $score = 0;
            $questions = Question::where('quiz_id', $quiz_id)->with('choices')->get();

            foreach ($questions as $index => $question) {
                $correctChoice = $question->choices->where('is_correct', 1)->first();
                if (isset($answers[$index]) && $correctChoice && $answers[$index] == $correctChoice->id) {
                    $score++;
                }
            }

            // Simpan hasil ke database `quiz_attempts`
            \DB::table('quiz_attempts')->insert([
                'quiz_id' => $quiz_id,
                'user_id' => $user_id,
                'score' => $score,
                'completed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('quiz.hasil', ['quiz_id' => $quiz_id]);
        }

        // Pindah ke soal selanjutnya
        return redirect()->route('quiz.soal', ['quiz_id' => $quiz_id, 'question' => $currentQuestionIndex + 1]);
    }



    // Menghitung skor
    public function hasil($quiz_id)
    {
        $user_id = Auth::id();
        $answers = session("answers_$quiz_id", []);
        $score = 0;

        $questions = Question::where('quiz_id', $quiz_id)->with('choices')->get();

        foreach ($questions as $index => $question) {
            $correctChoice = $question->choices->where('is_correct', 1)->first();
            if (isset($answers[$index]) && $correctChoice && $answers[$index] == $correctChoice->id) {
                $score++;
            }
        }

        $passingScore = ceil($questions->count() * 0.7);
        $userPassed = $score >= $passingScore; // Cek apakah user lulus

        return view('quiz.hasil', [
            'quiz_id' => $quiz_id, 
            'score' => $score,
            'totalQuestions' => $questions->count(),
            'passingScore' => $passingScore,
            'userPassed' => $userPassed
        ]);
    }


    // Reset quiz
    public function ulangi($quiz_id)
    {
        $user_id = Auth::id();

        // Cek apakah user sudah mencapai passing score
        $attempt = \DB::table('quiz_attempts')
            ->where('quiz_id', $quiz_id)
            ->where('user_id', $user_id)
            ->first();

        if ($attempt) {
            $totalQuestions = Question::where('quiz_id', $quiz_id)->count();
            $passingScore = ceil($totalQuestions * 0.7);

            if ($attempt->score >= $passingScore) {
                return redirect()->route('quiz.hasil', ['quiz_id' => $quiz_id])
                    ->with('error', 'Anda sudah lulus quiz ini dan tidak bisa mengulang.');
            }
        }

        // Jika belum lulus, reset jawaban
        session()->forget("answers_$quiz_id");

        return redirect()->route('quiz.soal', ['quiz_id' => $quiz_id]);
    }


}
