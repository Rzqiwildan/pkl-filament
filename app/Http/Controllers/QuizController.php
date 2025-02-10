<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelatihan;
use App\Models\HistoryUser;


class QuizController extends Controller
{
    // Daftar pertanyaan
    protected $questions = [
        ['question' => 'Apa ibukota Indonesia?', 'options' => ['Jakarta', 'Bandung', 'Surabaya', 'Medan'], 'answer' => 'Jakarta'],
        ['question' => 'Siapa presiden pertama Indonesia?', 'options' => ['Soekarno', 'Soeharto', 'Habibie', 'Megawati'], 'answer' => 'Soekarno'],
        ['question' => 'Berapa hasil dari 5 + 3?', 'options' => ['5', '8', '10', '12'], 'answer' => '8']
    ];

    // Menampilkan soal
    public function soal(Request $request)
    {
        $currentQuestion = $request->query('question', 0); // Soal aktif (default ke soal pertama)
        $answers = session('answers', []); // Jawaban yang sudah disimpan di session

        // Simpan waktu mulai quiz jika belum ada di session
        if (!session('quiz_start_time')) {
            session(['quiz_start_time' => now()]);
        }

        // Hitung waktu yang sudah berlalu
        $elapsedTime = now()->diffInSeconds(session('quiz_start_time'));
        $remainingTime = (30 * 60) - $elapsedTime; // 30 menit

        // Jika waktu habis, arahkan ke halaman hasil
        if ($remainingTime <= 0) {
            return redirect()->route('quiz.hasil');
        }

        return view('quiz.soal', [
            'questions' => $this->questions,
            'currentQuestion' => $currentQuestion,
            'answers' => $answers,  // Kirim jawaban yang sudah disimpan
            'remainingTime' => $remainingTime
        ]);
    }

    // Menyimpan jawaban per soal
    public function submitAnswer(Request $request)
    {
        // Ambil jawaban yang ada di session, jika belum ada, buat array kosong
        $answers = session('answers', []);

        // Ambil soal yang aktif (current question)
        $currentQuestion = (int) $request->input('next_question'); 

        // Jika ada jawaban, simpan di session
        if ($request->has('answer')) {
            $answers[$currentQuestion] = $request->input('answer');
        }

        // Simpan jawaban ke session
        session(['answers' => $answers]);

        // Arahkan ke soal berikutnya
        $nextQuestion = (int) $request->input('next_question', $currentQuestion);

        // Jika sudah mencapai soal terakhir, arahkan ke halaman hasil
        if ($nextQuestion >= count($this->questions)) {
            return redirect()->route('quiz.hasil');
        }

        return redirect()->route('quiz.soal', ['question' => $nextQuestion]);
    }

    // Menghitung skor dan menampilkan hasil
    public function hasil()
    {
        $answers = session('answers', []);
        $score = 0;

        foreach ($this->questions as $index => $question) {
            if (isset($answers[$index]) && $answers[$index] === $question['answer']) {
                $score++;
            }
        }

        $passingScore = ceil(count($this->questions) * 0.7); // Lulus jika minimal 70% benar

        // Jika sudah lulus, simpan hasil ke database history_user
        if ($score >= $passingScore) {
            $user = Auth::user();
            $pelatihan = Pelatihan::find(1); // Ambil pelatihan berdasarkan ID atau sesuai kebutuhan

            // Simpan ke history_user jika lulus
            HistoryUser::updateOrCreate(
                ['user_id' => $user->id, 'pelatihan_id' => $pelatihan->id],
                ['score' => $score]
            );
        }

        return view('quiz.hasil', [
            'score' => $score,
            'totalQuestions' => count($this->questions),
            'passingScore' => $passingScore
        ]);
    }


    // Reset jawaban untuk mengulang quiz
    public function ulangi()
    {
        session()->forget('answers'); // Hapus semua jawaban
        session()->forget('quiz_start_time'); // Hapus waktu mulai quiz
        return redirect()->route('quiz.soal'); // Kembali ke soal pertama
    }
}
