<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelatihan;
use App\Models\HistoryUser;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Choice;

class QuizController extends Controller
{
    // Menampilkan soal dari database
    public function soal(Request $request, $quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $questions = Question::where('quiz_id', $quiz_id)->with('choices')->get();

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
        $answers = session('answers', []);
        $currentQuestionIndex = (int) $request->input('current_question_index');

        if ($request->has('answer')) {
            $answers[$currentQuestionIndex] = $request->input('answer');
        }

        session(['answers' => $answers]);

        $nextQuestionIndex = $currentQuestionIndex + 1;
        $totalQuestions = Question::count();

        if ($nextQuestionIndex >= $totalQuestions) {
            return redirect()->route('quiz.hasil');
        }

        return redirect()->route('quiz.soal', ['question' => $nextQuestionIndex]);
    }

    // Menghitung skor
    public function hasil()
    {
        $answers = session('answers', []);
        $score = 0;
        
        $questions = Question::with('choices')->get();

        foreach ($questions as $index => $question) {
            $correctChoice = $question->choices->where('is_correct', 1)->first();
            if (isset($answers[$index]) && $correctChoice && $answers[$index] == $correctChoice->id) {
                $score++;
            }
        }

        $passingScore = ceil(count($questions) * 0.7);

        return view('quiz.hasil', [
            'score' => $score,
            'totalQuestions' => count($questions),
            'passingScore' => $passingScore
        ]);
    }

    // Reset quiz
    public function ulangi()
    {
        session()->forget('answers');
        return redirect()->route('quiz.soal');
    }
}

