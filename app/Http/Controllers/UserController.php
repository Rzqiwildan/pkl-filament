<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Pelatihan;
use App\Models\PelatihanPhotos;
use App\Models\Banner;
use App\Filament\Resources\PelatihanResource;
use App\Models\UserPelatihan;
use App\Models\JadwalPelatihan;
use App\Models\Umum; 
use App\Models\HistoryUser;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index()
    {
        // Ambil tanggal sekarang
        $now = Carbon::now();

        // Ambil pelatihan yang memiliki jadwal dan belum lewat dari end_date
        $pelatihans = Pelatihan::with(['photos', 'jadwalPelatihan'])
            ->whereHas('jadwalPelatihan', function ($query) use ($now) {
                $query->where('end_date', '>=', $now); // Hanya yang belum lewat end_date
            })
            ->get();

        // Ambil semua data lainnya
        $photos = PelatihanPhotos::all();
        $banners = Banner::all();
        $categories = Category::all();
        $jenisOptions = PelatihanResource::getJenisOptions();
        $kesulitanOptions = PelatihanResource::getKesulitanOptions();

        return view('user.dashboard', compact('pelatihans', 'photos', 'banners', 'categories', 'jenisOptions', 'kesulitanOptions'));
    }

    public function hasilPencarian(Request $request)
    {
        $query = $request->input('query');
        $pelatihans = Pelatihan::where('name', 'like', '%' . $query . '%')->get(); // Atau sesuaikan dengan field pencarian

        return view('user.hasil_pencarian', compact('pelatihans', 'query'));
    }

    public function myCourses()
    {
        // Pindahkan pelatihan yang sudah selesai ke history
        $this->updateUserPelatihanHistory(); 

        // Ambil tanggal sekarang
        $now = Carbon::now();

        // Ambil ID user yang sedang login
        $userId = Auth::id(); 

        // Ambil semua data pelatihan
        $pelatihans = Pelatihan::with(['photos', 'jadwalPelatihan'])
            ->whereHas('jadwalPelatihan', function ($query) use ($now) {
                $query->where('end_date', '>=', $now); // Hanya yang belum lewat end_date
            })
            ->get(); 

        // Ambil semua data foto (jika tetap ingin menyimpan $photos terpisah)
        $photos = PelatihanPhotos::all();

        // Ambil semua pelatihan yang diikuti oleh user yang BELUM berakhir
        $user_pelatihans = UserPelatihan::where('user_id', $userId)
            ->whereHas('pelatihan.jadwalPelatihan', function ($query) use ($now) {
                $query->where('end_date', '>=', $now);
            })
            ->with('pelatihan.photos')
            ->get();

        return view('user.course', compact('user_pelatihans', 'pelatihans', 'photos')); // Pastikan variabel ini diteruskan ke view
    }

    public function updateUserPelatihanHistory()
    {
        $now = Carbon::now();
        $userId = Auth::id();

        // Ambil semua pelatihan yang sudah berakhir dan diikuti oleh user
        $expiredPelatihans = UserPelatihan::where('user_id', $userId)
            ->whereHas('pelatihan.jadwalPelatihan', function ($query) use ($now) {
                $query->where('end_date', '<', $now); // Pelatihan yang sudah berakhir
            })
            ->get();

        foreach ($expiredPelatihans as $pelatihan) {
            // Pastikan data belum ada di history_users agar tidak duplikat
            $exists = HistoryUser::where('user_id', $userId)
                ->where('pelatihan_id', $pelatihan->pelatihan_id)
                ->exists();

            if (!$exists) {
                HistoryUser::create([
                    'user_id' => $userId,
                    'pelatihan_id' => $pelatihan->pelatihan_id,
                    'score' => $pelatihan->pelatihan->jenis === 'online' ? $this->getUserScore($userId, $pelatihan->pelatihan_id) : null,
                ]);
            }

            // Hapus dari tabel user_pelatihans
            $pelatihan->delete();
        }
    }

    // Dummy function untuk mengambil score jika pelatihan online
    private function getUserScore($userId, $pelatihanId)
    {
        // Misalnya kita ambil dari tabel `quiz_results`, sesuaikan dengan struktur database kamu
        return DB::table('quiz_results')
            ->where('user_id', $userId)
            ->where('pelatihan_id', $pelatihanId)
            ->value('score') ?? null;
    }

    public function ikutPelatihan(Request $request)
    {
        $request->validate([
            'pelatihan_id' => 'required|exists:pelatihans,id',
        ]);

        $userId = Auth::id();
        $pelatihanId = $request->pelatihan_id;

        // Ambil data pelatihan
        $pelatihan = Pelatihan::findOrFail($pelatihanId);

        // Cek apakah kuota masih tersedia
        if ($pelatihan->kapasitas <= 0) {
            return redirect()->back()->with('error', 'Kuota sudah penuh.');
        }

        // Cek apakah user sudah terdaftar
        $isAlreadyRegistered = UserPelatihan::where('user_id', $userId)
                                            ->where('pelatihan_id', $pelatihanId)
                                            ->exists();

        if ($isAlreadyRegistered) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar dalam pelatihan ini.');
        }

        // Simpan data pendaftaran
        UserPelatihan::create([
            'user_id' => $userId,
            'pelatihan_id' => $pelatihanId,
        ]);

        // Kurangi kapasitas pelatihan
        $pelatihan->decrement('kapasitas');

        return redirect()->back()->with('success', 'Anda telah berhasil mengikuti pelatihan!');
    }

    public function ikutPelatihanOn(Request $request, $id)
    {
        $pelatihan = Pelatihan::findOrFail($id);

        // Cek apakah jenis pelatihan adalah online
        if ($pelatihan->jenis !== 'online') {
            return response()->json(['error' => 'Pelatihan ini tidak tersedia untuk pendaftaran online.'], 400);
        }

        // Cek apakah kuota masih tersedia
        if ($pelatihan->kapasitas <= 0) {
            return response()->json(['error' => 'Kuota sudah penuh.'], 400);
        }

        $userId = Auth::id();

        // Cek apakah user sudah terdaftar
        $isAlreadyRegistered = UserPelatihan::where('user_id', $userId)
                                            ->where('pelatihan_id', $id)
                                            ->exists();

        if ($isAlreadyRegistered) {
            return response()->json(['error' => 'Anda sudah terdaftar dalam pelatihan ini.'], 400);
        }

        // Simpan data pendaftaran
        UserPelatihan::create([
            'user_id' => $userId,
            'pelatihan_id' => $id,
        ]);

        // Kurangi kapasitas pelatihan
        $pelatihan->decrement('kapasitas');

        // Kembalikan respons JSON jika berhasil
        return response()->json(['success' => true]);
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
        Log::info("Mencari pelatihan dengan query: " . $query);

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

    public function offline($id)
    {
        $pelatihan = Pelatihan::find($id);

        // Cek apakah pelatihan berbayar
        if ($pelatihan->is_paid) {
            return redirect()->route('payment.show', ['id' => $id]);  // Redirect ke halaman pembayaran
        }

        // Cek apakah pengguna sudah terdaftar
        // $isRegistered = $pelatihan->users()->where('user_id', auth()->id())->exists();
        // Mengambil data Pelatihan beserta foto yang terkait
        $pelatihans = Pelatihan::with('photos')->where('id', $id)->first();

        // Mengambil data JadwalPelatihan berdasarkan pelatihan_id
        $jadwalPelatihan = JadwalPelatihan::where('pelatihan_id', $id)->first();

        // Cek apakah pengguna sudah terdaftar untuk pelatihan ini
        $isRegistered = UserPelatihan::where('user_id', Auth::id())
            ->where('pelatihan_id', $id)
            ->exists();

            if (request()->has('pdf') && $jadwalPelatihan->file_pdf) {
                // Ambil path file PDF
                $path = storage_path('app/public/' . $jadwalPelatihan->jadwal);
                
                // Cek apakah file exist
                if (file_exists($path)) {
                    return response()->file($path);
                    // Atau jika ingin di-download:
                    // return response()->download($path, 'jadwal-pelatihan.pdf');
                }
            }
        // Mengirim data pelatihans, jadwalPelatihan, dan isRegistered ke view
        return view('user.offline', compact('pelatihans', 'jadwalPelatihan', 'isRegistered'));

        // return view('offline', compact('pelatihan', 'isRegistered'));
    }

    public function daftarPelatihan(Request $request)
    {
        $pelatihan = Pelatihan::find($request->pelatihan_id);

        if ($pelatihan->harga == 0) {
            // Logika untuk registrasi otomatis saat pelatihan gratis
            // Contoh, menambahkan user ke database
            Auth::user()->pelatihan()->attach($pelatihan->id);

            // Notifikasi
            session()->flash('success', 'Anda telah berhasil mendaftar pelatihan!');
            return back(); // Kembali ke halaman yang sama
        }

        // Redirect ke halaman pembayaran jika pelatihan berbayar
        return redirect()->route('payment.show', ['id' => $pelatihan->id]);
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

    public function payment($id)
    {
        $pelatihan = Pelatihan::findOrFail($id); // Ambil data pelatihan berdasarkan ID
        return view('user.payment', compact('pelatihan'));
    }

    public function history()
    {
        $userId = Auth::id();

        // Ambil pelatihan yang sudah selesai dari history_users
        $user_histories = HistoryUser::where('user_id', $userId)
            ->with('pelatihan.photos') // Pastikan relasi sudah benar
            ->get();

        return view('user.history', compact('user_histories'));
    }

    public function profil()
    {
        $nik = Umum::first()->nik; // Mengambil NIK pertama dari tabel umums
        return view('user.profil', compact('nik'));
    }
}