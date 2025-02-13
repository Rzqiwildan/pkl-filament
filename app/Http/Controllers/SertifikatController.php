<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz_attempt;
use App\Models\Pelatihan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class SertifikatController extends Controller
{
    // Menampilkan sertifikat jika user lulus
    public function show($quiz_id)
    {
        $user = Auth::user();

        // Ambil attempt terakhir user untuk quiz ini
        $quizAttempt = Quiz_attempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz_id)
            ->first();

        // Cek apakah user lulus
        if (!$quizAttempt || $quizAttempt->score < $quizAttempt->quiz->passing_score) {
            return redirect()->route('pelatihan.index')->with('error', 'Anda belum lulus quiz ini.');
        }

        return view('quiz.sertifikat', compact('user', 'quizAttempt'));
    }

    // Download sertifikat dalam format PDF
    public function download($quiz_id)
    {
        $user = Auth::user();

        // Ambil attempt terakhir user untuk quiz ini
        $quizAttempt = Quiz_attempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz_id)
            ->firstOrFail();

        // Cek apakah user lulus
        if ($quizAttempt->score < $quizAttempt->quiz->passing_score) {
            return redirect()->route('pelatihan.index')->with('error', 'Anda belum lulus quiz ini.');
        }

        // Generate PDF Sertifikat
        $pdf = Pdf::loadView('sertifikat_pdf', compact('user', 'quizAttempt'));

        return $pdf->download('quiz.sertifikat' . $user->name . '.pdf');
    }
}
