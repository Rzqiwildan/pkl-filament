<?php

namespace App\Http\Controllers;

use App\Models\BagianPelatihan;
use App\Models\Materi;
use App\Models\Pelatihan;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Menampilkan dashboard teacher dengan daftar pelatihan yang mereka ajarkan.
     */
    public function index()
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();

        if (!$teacher) {
            return redirect()->back()->with('error', 'Anda belum terdaftar sebagai teacher');
        }

        // Ambil semua pelatihan yang diajarkan oleh teacher dari tabel pivot
        $pelatihans = $teacher->pelatihans()->with(['category', 'materis', 'jadwalPelatihan', 'photos'])->get();

        return view('teacher.dashboard', compact('pelatihans', 'teacher'));
    }

    /**
     * Menampilkan daftar pelatihan yang diajarkan oleh teacher.
     */
    public function courseT()
{
    $teacher = auth()->user()->teacher;

    if (!$teacher) {
        return redirect()->route('teacher.dashboard')->with('error', 'Anda belum terdaftar sebagai teacher.');
    }

    // Pastikan mengambil pelatihan dengan relasi materis
    $pelatihans = $teacher->pelatihans()->with('materis')->get();

    // Kirim $pelatihans ke view
    return view('teacher.courseT', compact('pelatihans'));
}

    /**
     * Menampilkan halaman upload materi untuk pelatihan tertentu.
     */
    public function uploadMateri($pelatihanId)
{
    $teacher = auth()->user()->teacher;

    if (!$teacher) {
        return redirect()->route('teacher.dashboard')->with('error', 'Anda belum terdaftar sebagai teacher.');
    }

    $pelatihan = $teacher->pelatihans()
        ->where('pelatihan_teacher.pelatihan_id', $pelatihanId)
        ->with('bagianPelatihans.materis')
        ->first();

    if (!$pelatihan) {
        return redirect()->route('teacher.courseT')->with('error', 'Pelatihan tidak ditemukan atau Anda tidak memiliki akses.');
    }

    return view('teacher.uploadMateri', compact('pelatihan'));
}

public function storeMateri(Request $request, $bagianId)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'file' => 'nullable|file|mimes:pdf,ppt,pptx|max:5120',
        'link' => 'nullable|url',
    ]);

    $bagian = BagianPelatihan::findOrFail($bagianId);

    $materi = new Materi();
    $materi->title = $request->title;
    $materi->bagian_pelatihan_id = $bagianId;

    if ($request->hasFile('file')) {
        $materi->file_path = $request->file('file')->store('materi', 'public');
    }

    if ($request->filled('link')) {
        $materi->link = $request->link;
    }

    $materi->save();

    return redirect()->route('teacher.uploadMateri', $bagian->pelatihan_id)->with('success', 'Materi berhasil diunggah!');
}

public function storeBagian(Request $request, $pelatihanId)
{
    $request->validate([
        'nama_bagian' => 'required|string|max:255',
    ]);

    $pelatihan = auth()->user()->teacher->pelatihans()
        ->where('pelatihan_teacher.pelatihan_id', $pelatihanId)
        ->first();

    if (!$pelatihan) {
        return redirect()->route('teacher.uploadMateri', $pelatihanId)->with('error', 'Pelatihan tidak ditemukan atau Anda tidak memiliki akses.');
    }

    BagianPelatihan::create([
        'pelatihan_id' => $pelatihanId,
        'nama_bagian' => $request->nama_bagian,
    ]);

    return redirect()->route('teacher.uploadMateri', $pelatihanId)->with('success', 'Bagian berhasil ditambahkan!');
}

public function deleteBagian($bagianId)
{
    $bagian = BagianPelatihan::findOrFail($bagianId);

    // Pastikan hanya teacher yang memiliki akses yang bisa menghapus
    $teacher = auth()->user()->teacher;
    if (!$teacher || !$teacher->pelatihans->contains($bagian->pelatihan_id)) {
        return redirect()->route('teacher.uploadMateri', $bagian->pelatihan_id)->with('error', 'Anda tidak memiliki akses untuk menghapus bagian ini.');
    }

    $bagian->delete();

    return redirect()->route('teacher.uploadMateri', $bagian->pelatihan_id)->with('success', 'Bagian berhasil dihapus!');
}


    /**
     * Menampilkan halaman profil teacher.
     */
    public function profile()
    {
        return view('teacher.profile');
    }
}