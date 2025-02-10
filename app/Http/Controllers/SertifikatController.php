<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HistoryUser;
use App\Models\Pelatihan;


class SertifikatController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $pelatihan = Pelatihan::find($request->pelatihan_id);

        // Cek apakah pengguna sudah mendapatkan skor pelatihan
        $history = HistoryUser::where('user_id', $user->id)
            ->where('pelatihan_id', $pelatihan->id)
            ->first();

        if (!$history || $history->score < 60) {
            return redirect()->route('pelatihan.index')->with('error', 'Anda belum lulus pelatihan ini atau skor Anda kurang.');
        }

        // Tampilkan halaman sertifikat jika skor mencukupi
        return view('sertifikat', compact('user', 'pelatihan'));
    }

    public function download($user_id, $pelatihan_id)
    {
        $user = User::findOrFail($user_id);
        $pelatihan = Pelatihan::findOrFail($pelatihan_id);

        // Generate PDF untuk sertifikat
        $pdf = PDF::loadView('sertifikat_pdf', compact('user', 'pelatihan'));

        // Simpan atau unduh sertifikat dalam format PDF
        return $pdf->download('sertifikat_' . $user->name . '.pdf');
    }
}

