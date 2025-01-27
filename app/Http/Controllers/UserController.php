<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Pelatihan;
use App\Models\Pelatihan_Photos;
use App\Models\Banner;
use App\Filament\Resources\PelatihanResource;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua data pelatihan
        $pelatihans = Pelatihan::with('photos')->get(); 

        // Ambil semua data foto (jika tetap ingin menyimpan $photos terpisah)
        $photos = Pelatihan_Photos::all();

        // Ambil semua data banner
        $banners = Banner::all();

        // Ambil semua data banner
        $categories = Category::all();

        $jenisOptions = PelatihanResource::getJenisOptions();
        $kesulitanOptions = PelatihanResource::getKesulitanOptions();

        // Kirimkan semua data ke view
        return view('user.dashboard', compact('pelatihans', 'photos', 'banners', 'categories', 'jenisOptions', 'kesulitanOptions'));
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




    public function course1($id)
    {
        $pelatihans = Pelatihan::with('photos')->where('id', $id)->first();
        
        return view('user.course1', compact('pelatihans'));
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



    public function course()
    {
        // Logic untuk halaman My Course
        return view('user.course');
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
        
        return view('user.offline', compact('pelatihans'));
        // return view('user.offline');
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