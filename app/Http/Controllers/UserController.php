<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Pelatihan;
use App\Models\PelatihanPhotos;
use App\Models\Banner;
use App\Filament\Resources\PelatihanResource;
use App\Models\UserPelatihan;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua data pelatihan
        $pelatihans = Pelatihan::with('photos')->get(); 

        // Ambil semua data foto (jika tetap ingin menyimpan $photos terpisah)
        $photos = PelatihanPhotos::all();

        // Ambil semua data banner
        $banners = Banner::all();

        // Ambil semua data banner
        $categories = Category::all();

        $jenisOptions = PelatihanResource::getJenisOptions();
        $kesulitanOptions = PelatihanResource::getKesulitanOptions();

        // Kirimkan semua data ke view
        return view('user.dashboard', compact('pelatihans', 'photos', 'banners', 'categories', 'jenisOptions', 'kesulitanOptions'));
    }

    public function myCourses()
    {
        // Ambil semua data pelatihan
        $pelatihans = Pelatihan::with('photos')->get(); 

        // Ambil semua data foto (jika tetap ingin menyimpan $photos terpisah)
        $photos = PelatihanPhotos::all();

        $userId = Auth::id(); // Ambil ID user yang sedang login

        // Ambil semua pelatihan yang diikuti oleh user ini
        $user_pelatihans = UserPelatihan::where('user_id', $userId)
                                ->with('pelatihan') // Ambil data pelatihannya juga
                                ->get();

        return view('user.course', compact('user_pelatihans', 'pelatihans', 'photos')); // Pastikan variabel ini diteruskan ke view
    }


    public function ikutPelatihan(Request $request)
    {
        $request->validate([
            'pelatihan_id' => 'required|exists:pelatihans,id',
        ]);

        $userId = Auth::id();
        $pelatihanId = $request->pelatihan_id;

        // Cek apakah user sudah terdaftar
        $isAlreadyRegistered = UserPelatihan::where('user_id', $userId)
                                            ->where('pelatihan_id', $pelatihanId)
                                            ->exists();

        if ($isAlreadyRegistered) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar dalam pelatihan ini.');
        }

        // Simpan data jika belum terdaftar
        UserPelatihan::create([
            'user_id' => $userId,
            'pelatihan_id' => $pelatihanId,
        ]);

        return redirect()->back()->with('success', 'Anda telah berhasil mengikuti pelatihan!');
    }

    public function ikutPelatihanOn(Request $request, $id)
    {
        $pelatihan = Pelatihan::findOrFail($id);

        // Cek apakah jenis pelatihan adalah online
        if ($pelatihan->jenis !== 'online') {
            return response()->json(['error' => 'Pelatihan ini tidak tersedia untuk pendaftaran online.'], 400);
        }

        $userId = Auth::id();
        $pelatihanId = $id;

        // Cek apakah user sudah terdaftar
        $isAlreadyRegistered = UserPelatihan::where('user_id', $userId)
                                            ->where('pelatihan_id', $pelatihanId)
                                            ->exists();

        if ($isAlreadyRegistered) {
            return response()->json(['error' => 'Anda sudah terdaftar dalam pelatihan ini.'], 400);
        }

        // Simpan data jika belum terdaftar
        UserPelatihan::create([
            'user_id' => $userId,
            'pelatihan_id' => $pelatihanId,
        ]);

        return response()->json(['success' => true, 'message' => 'Anda telah berhasil mengikuti pelatihan online!']);
    }

    public function getPelatihan()
    {
        $pelatihans = Pelatihan::all();
        \Log::info($pelatihans); // Untuk logging data ke storage/logs/laravel.log
        dd($pelatihans); // Memastikan data sampai ke sini

        return view('User.course', compact('pelatihans'));
    }

    public function simpanPelatihan(Request $request)
    {
        $userPelatihan = new UserPelatihan();
        $userPelatihan->user_id = $request->user_id;
        $userPelatihan->pelatihan_id = $request->pelatihan_id;
        $userPelatihan->save();

        return response()->json(['message' => 'Pelatihan berhasil disimpan!']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['error' => 'Query kosong'], 400);
        }

        // Debugging: tampilkan query yang dijalankan
        \Log::info("Mencari pelatihan dengan query: " . $query);

        $results = Pelatihan::where('name', 'LIKE', "%{$query}%")->limit(5)->get();

        return response()->json($results);
    }

    public function course1($id)
    {
        // Cek apakah user sudah terdaftar di pelatihan ini
        $isRegistered = UserPelatihan::where('user_id', Auth::id())
        ->where('pelatihan_id', $id)
        ->exists();
        
        $pelatihans = Pelatihan::with('photos')->where('id', $id)->first();
        
        return view('user.course1', compact('pelatihans', 'isRegistered'));
    }

    public function showKategori($id)
    {
        // Ambil data kategori berdasarkan ID
        $categories = Category::findOrFail($id);

        // Ambil data pelatihan yang memiliki kategori_id yang sama dengan ID kategori
        $pelatihans = Pelatihan::where('category_id', $id)->get();

        // Kirim data kategori dan pelatihan ke view
        return view('user.kategori', compact('categories', 'pelatihans'));
    }

    public function showBanner($id)
    {
        // Ambil data banner berdasarkan ID
        $pelatihans = Pelatihan::findOrFail($id);  // Ganti nama variabel menjadi $pelatihans

        // Ambil data banner berdasarkan ID
        $banners = Banner::findOrFail($id);  // Gunakan $banners

        // Arahkan ke halaman detail banner
        return view('user.banner3', compact('pelatihans', 'banners'));  // Kirim variabel $pelatihans ke view
    }

    public function course2()
    {
    return view('user.course2');
    }

    public function course3()
    {
        return view('user.course3');
    }

    public function offline($id)
    {
        $pelatihans = Pelatihan::with('photos')->where('id', $id)->first();

        // Cek apakah user sudah terdaftar di pelatihan ini
        $isRegistered = UserPelatihan::where('user_id', Auth::id())
        ->where('pelatihan_id', $id)
        ->exists();
        
        return view('user.offline', compact('pelatihans', 'isRegistered'));
    }

    public function online($id)
    {
        $pelatihans = Pelatihan::with('photos')->where('id', $id)->first();
        
        return view('user.online', compact('pelatihans'));
        // return view('user.online');
    }

    public function quiz1()
    {
        return view('user.quiz1');
    }

    public function mycourse1()
    {
        return view('user.mycourse1');
    }

    public function banner3()
    {
        return view('user.banner3');
    }

    public function payment()
    {
        return view('user.payment');
    }

    public function history()
    {
        return view('user.history');
    }

    public function profil()
    {
        return view('user.profil');
    }
}