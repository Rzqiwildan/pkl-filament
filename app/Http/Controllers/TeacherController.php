<?php

namespace App\Http\Controllers;

use App\Models\BagianPelatihan;
use App\Models\Choice;
use App\Models\Materi;
use App\Models\Pelatihan;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        // Debugging untuk melihat bagian dan materi yang terkait
    // foreach ($pelatihan->bagianPelatihans as $bagian){
    //     dd($bagian->materi);
    // }

    if (!$pelatihan) {
        return redirect()->route('teacher.courseT')->with('error', 'Pelatihan tidak ditemukan atau Anda tidak memiliki akses.');
    }

    return view('teacher.uploadMateri', compact('pelatihan'));
}

public function storeMateri(Request $request, $bagianId)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'file' => 'nullable|file|mimes:pdf,ppt,pptx|max:5120',
        'link' => 'nullable|url',
    ]);

    $bagian = BagianPelatihan::findOrFail($bagianId);

    $materi = new Materi();
    $materi->name = $request->name;
    $materi->bagian_pelatihan_id = $bagianId;
    $materi->pelatihan_id = $bagian->pelatihan_id; // ✅ Tambahkan pelatihan_id agar tidak error

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

    // Cek apakah pelatihan ada dan apakah jenisnya online
    if (!$pelatihan || $pelatihan->jenis !== 'online') {
        return redirect()->route('teacher.uploadMateri', $pelatihanId)
            ->with('error', 'Bagian hanya dapat dibuat untuk pelatihan online.');
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


public function deleteMateri(Materi $materi)
{
    $bagianId = $materi->bagian_pelatihan_id;
    
    // Hapus file jika ada
    if ($materi->file_path) {
        Storage::disk('public')->delete($materi->file_path);
    }

    $materi->delete();

    return redirect()->route('teacher.uploadMateri', $bagianId)
        ->with('success', 'Materi berhasil dihapus!');
}


public function storeBagianQuiz(Request $request, $pelatihanId)
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

    if ($pelatihan->jenis_pelatihan !== 'online') {
        return redirect()->route('teacher.uploadMateri', $pelatihanId)
            ->with('error', 'Bagian hanya dapat dibuat untuk pelatihan online.');
    }

    BagianPelatihan::create([
        'pelatihan_id' => $pelatihanId,
        'nama_bagian' => $request->nama_bagian,
        'is_quiz' => true, // Menandakan bagian ini adalah untuk quiz
    ]);

    return redirect()->route('teacher.uploadMateri', $pelatihanId)->with('success', 'Bagian Quiz berhasil ditambahkan!');
}

    // Menampilkan form tambah quiz
    public function createQuiz($bagianId)
    {
        $bagian = BagianPelatihan::findOrFail($bagianId);

        return view('teacher.addQuiz', compact('bagian'));
    }

    // Menyimpan quiz baru
    public function storeQuiz(Request $request, $bagianId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
        ]);

        $quiz = Quiz::create([
            'bagian_pelatihan_id' => $bagianId,
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
        ]);

        return redirect()->route('teacher.uploadMateri', $quiz->bagian_pelatihan_id)
                        ->with('success', 'Quiz berhasil ditambahkan!');
    }

    // Menampilkan quiz beserta soalnya
    public function showQuiz($quizId)
    {
        $quiz = Quiz::with('questions.choices')->findOrFail($quizId);

        return view('teacher.viewQuiz', compact('quiz'));
    }

    // Menyimpan pertanyaan dalam quiz
    public function storeQuestion(Request $request, $quizId)
    {
        $request->validate([
            'question' => 'required|string',
            'choices.*.choice_text' => 'required|string',
            'correct_choice' => 'required|integer|min:0|max:3',
        ]);

        $question = Question::create([
            'quiz_id' => $quizId,
            'question' => $request->question,
        ]);

        foreach ($request->choices as $index => $choice) {
            Choice::create([
                'question_id' => $question->id,
                'choice_text' => $choice['choice_text'],
                'is_correct' => $index == $request->correct_choice,
            ]);
        }

        return redirect()->route('teacher.showQuiz', $quizId)->with('success', 'Soal berhasil ditambahkan!');
    }

    // Menghapus quiz beserta soalnya
    public function deleteQuiz($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $quiz->delete();

        return redirect()->route('teacher.uploadMateri', $quiz->bagian_pelatihan_id)
                        ->with('success', 'Quiz berhasil dihapus!');
    }
    public function editQuestion($quizId, $questionId)
{
    $quiz = Quiz::findOrFail($quizId);
    $question = Question::with('choices')->findOrFail($questionId);

    return view('teacher.editQuestion', compact('quiz', 'question'));
}

public function updateQuestion(Request $request, $quizId, $questionId)
{
    $request->validate([
        'question' => 'required|string',
        'choices.*.choice_text' => 'required|string',
        'correct_choice' => 'required|integer|min:0|max:3',
    ]);

    // Update pertanyaan
    $question = Question::findOrFail($questionId);
    $question->update([
        'question' => $request->question,
    ]);

    // Update pilihan jawaban
    foreach ($request->choices as $index => $choice) {
        $existingChoice = Choice::where('question_id', $question->id)->skip($index)->first();
        if ($existingChoice) {
            $existingChoice->update([
                'choice_text' => $choice['choice_text'],
                'is_correct' => $index == $request->correct_choice,
            ]);
        }
    }

    return redirect()->route('teacher.showQuiz', $quizId)->with('success', 'Soal berhasil diperbarui!');
}



    /**
     * Menampilkan halaman profil teacher.
     */
    public function profile()
{
    $teacher = Teacher::where('user_id', Auth::id())->with('user')->first();

    if (!$teacher) {
        return redirect()->route('teacher.dashboard')->with('error', 'Anda belum terdaftar sebagai teacher.');
    }

    // Pastikan data dikirim ke view
    return view('teacher.profileT', compact('teacher'));
}

public function updateProfile(Request $request)
{
    $request->validate([
        'nip' => 'required|numeric|max:20',
        'no_telp' => 'nullable|numeric|max:15',
        'tgl_lahir' => 'nullable|date',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ]);

    $teacher = Teacher::where('user_id', Auth::id())->first();

    if (!$teacher) {
        return redirect()->route('teacher.profile')->with('error', 'Anda belum terdaftar sebagai teacher.');
    }

    // Update data teacher
    $teacher->nip = $request->nip;
    $teacher->no_telp = $request->no_telp;
    $teacher->tgl_lahir = $request->tgl_lahir;

    if ($request->hasFile('profile_photo')) {
        // Hapus foto lama jika ada
        if ($teacher->profile_photo_path) {
            Storage::disk('public')->delete($teacher->profile_photo_path);
        }

        // Simpan foto baru
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $teacher->profile_photo_path = $path;
    }

    $teacher->save();

    return redirect()->route('teacher.profile')->with('success', 'Profil berhasil diperbarui!');
    }
}