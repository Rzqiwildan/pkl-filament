<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Pelatihan;
use App\Models\PelatihanPhotos;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
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

        // Kirimkan semua data ke view
        return view('welcome', compact('pelatihans', 'photos', 'banners', 'categories'));
    }
}