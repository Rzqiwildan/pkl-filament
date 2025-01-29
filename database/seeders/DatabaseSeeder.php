<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\PelatihanPhotos;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Banner::create([
        //     'cover_banner' => 'img/banner2.png',
        //     'rincian_banner' => 'img/b2.png',
        //     'pelatihan_id' => 2,
        //     'order' => 1,
        //     'status' => true,
        // ]);

        Banner::create([
            'cover_banner' => 'img/banner3.png',
            'rincian_banner' => 'img/b3.png',
            'pelatihan_id' => 5,
            'order' => 1,
            'status' => true,
        ]);

        Banner::create([
            'cover_banner' => 'img/banner2.png',
            'rincian_banner' => 'img/b2.png',
            'pelatihan_id' => 6,
            'order' => 1,
            'status' => true,
        ]);

        // Category::create([
        //     'name' => 'Bisnis',
        //     'slug' => 'bisnis',
        //     'image' => 'img/bisnis.jpg',
        // ]);

        // PelatihanPhotos::create([
        //     'photo' => 'img/daspro.jpg',
        //     'pelatihan_id' => 3,
        // ]);

        // PelatihanPhotos::create([
        //     'photo' => 'img/pbo.jpg',
        //     'pelatihan_id' => 4,
        // ]);

        // PelatihanPhotos::create([
        //     'photo' => 'img/jarkom.jpg',
        //     'pelatihan_id' => 5,
        // ]);

        // PelatihanPhotos::create([
        //     'photo' => 'img/jahit.jpg',
        //     'pelatihan_id' => 6,
        // ]);
        

    }
}
