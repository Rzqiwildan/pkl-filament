<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pelatihan; // Tambahkan model Pelatihan jika digunakan di form
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    /**
     * Menampilkan form upload bukti pembayaran
     */
    public function create()
{
    $pelatihans = \App\Models\Pelatihan::all(); // Ambil semua pelatihan dari database

    return view('upload', compact('pelatihans')); // Kirim variabel ke view
}

    /**
     * Menyimpan bukti pembayaran ke database
     */
    public function store(Request $request)
{
    // Debugging untuk cek apakah request masuk
    // dd($request->all());

    // Validasi input
    $request->validate([
        'pelatihan_id' => 'required|exists:pelatihans,id',
        'bukti_pembayaran' => 'required|file|mimes:jpg,png,pdf|max:5120',
    ]);

    // Simpan file bukti pembayaran ke folder storage/public/bukti_pembayaran
    $file = $request->file('bukti_pembayaran');
    $filePath = $file->store('bukti_pembayaran', 'public');

    // Simpan data transaksi ke database
    $transaksi = Transaksi::create([
        'user_id' => Auth::id(),
        'pelatihan_id' => $request->pelatihan_id,
        'bukti_pembayaran' => $filePath,
        'status_pembayaran' => 'pending', // Status awal
    ]);

    // Debugging: Periksa apakah transaksi tersimpan
    // dd($transaksi);

    return redirect()->route('transaksi.index')->with('success', 'Bukti pembayaran berhasil diunggah, menunggu verifikasi.');
}


    /**
     * Menampilkan daftar transaksi user yang sedang login
     */
    public function index()
    {
        $transaksis = Transaksi::where('user_id', Auth::id())->with('pelatihan')->get();

        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Menampilkan detail transaksi berdasarkan ID
     */
    public function show($id)
{
    $pelatihan = Pelatihan::find($id);
    return view('user.payment', compact('pelatihan'));
}

    /**
     * Menghapus transaksi (jika diizinkan)
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Hapus file bukti pembayaran jika ada
        if ($transaksi->bukti_pembayaran) {
            Storage::disk('public')->delete($transaksi->bukti_pembayaran);
        }

        $transaksi->delete();

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
