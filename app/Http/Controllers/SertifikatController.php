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

    $quizAttempt = Quiz_attempt::with(['quiz.bagianPelatihan.pelatihan', 'user'])
        ->where('user_id', $user->id)
        ->where('quiz_id', $quiz_id)
        ->first();

    if (!$quizAttempt) {
        return redirect()->route('pelatihan.index')
            ->with('error', 'Data quiz tidak ditemukan.');
    }

    return view('quiz.sertifikat', compact('quizAttempt'));
}

    // Download sertifikat dalam format PDF
    public function download($quiz_id)
{
    $user = Auth::user();

    $quizAttempt = Quiz_attempt::with(['quiz.bagianPelatihan.pelatihan', 'user'])
        ->where('user_id', $user->id)
        ->where('quiz_id', $quiz_id)
        ->firstOrFail();

    // Generate PDF Sertifikat
    $pdf = PDF::loadView('Quiz.sertifikat_pdf', compact('quizAttempt'))
    ->setPaper('a4', 'landscape')
    ->setOptions([
        'dpi' => 150,
        'defaultFont' => 'sans-serif',
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true
    ]);

    return $pdf->download('Sertifikat_'.$user->name.'.pdf');
}
}