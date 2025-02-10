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
    $request->validate([
        'pelatihan_id' => 'required|exists:pelatihans,id',
        'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('bukti_pembayaran')) {
        $file = $request->file('bukti_pembayaran');
        $filename = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('bukti_pembayaran', $filename, 'public');

        dd('Mau simpan ke database:', [
            'user_id' => auth()->id(),
            'pelatihan_id' => $request->pelatihan_id,
            'bukti_pembayaran' => $filePath,
            'status_pembayaran' => 'pending',
        ]);

        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'pelatihan_id' => $request->pelatihan_id,
            'status_pembayaran' => 'pending',
            'bukti_pembayaran' => $filePath,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Bukti pembayaran berhasil diunggah!');
    }

    return back()->with('error', 'Gagal mengunggah bukti pembayaran.');
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
