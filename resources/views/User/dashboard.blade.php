<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('components.navbar')
    <!-- Carousel -->
    <div class="container mx-auto mt-24" style="width: 90%;">
        <div class="splide_banner rounded-md" style="width: 100%; max-height: 12rem; overflow: hidden; position: relative;">
            <div class="splide__track" style="width: 100%; height: 100%;">
                <ul class="splide__list" style="margin: 0; padding: 0; display: flex;">
                    <!-- Slide 1 -->
                    <li class="splide__slide" style="flex: 0 0 100%; text-align: center;">
                        <img 
                            src="{{ asset('img/banner1.png') }}" 
                            style="width: 100%; height: auto; object-fit: cover;"
                        />
                    </li>
                    <!-- Slide 2 -->
                    <li class="splide__slide" style="flex: 0 0 100%; text-align: center;">
                        <img 
                            src="{{ asset('img/banner2.png') }}" 
                            style="width: 100%; height: auto; object-fit: cover;"
                        />
                    </li>
                    <!-- Slide 3 -->
                    <li class="splide__slide" style="flex: 0 0 100%; text-align: center;">
                        <a href="{{ route('user.banner3') }}">
                            <img 
                                src="{{ asset('img/banner3.png') }}" 
                                style="width: 100%; height: auto; object-fit: cover;"
                            />
                        </a>
                    </li>
                    <!-- Slide 4 -->
                    <li class="splide__slide" style="flex: 0 0 100%; text-align: center;">
                        <img 
                            src="{{ asset('img/banner2.png') }}" 
                            style="width: 100%; height: auto; object-fit: cover;"
                        />
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Splide JS -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/css/splide.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var splide = new Splide('.splide_banner', {
                type       : 'loop',      // Slider akan looping
                perPage    : 1,           // Tampilkan 1 banner per halaman
                perMove    : 1,           // Bergerak 1 banner setiap kali
                gap        : '0rem',      // Tidak ada jarak antar banner
                autoplay   : true,        // Auto play slider
                interval   : 3000,        // Durasi antar slide (ms)
                arrows     : true,        // Tombol navigasi prev/next
                pagination : true,        // Pagination bulatan
            });
            splide.mount();
        });
    </script>

    <!-- Filters -->
    <div class="container mx-auto mt-8 flex space-x-4 mb-8 mt-8" style="width: 90%;">
        <!-- Input -->
        <input type="text" placeholder="Cari pelatihan, lokasi pelatihan, dll" class="p-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" style="width: 30%; border: 1px solid #a2a2a2; height: 2rem; line-height: 2rem; text-align: left; font-size: 0.875rem;"/>
        <!-- Select: Jenis Pelatihan -->
        <select class="border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" style="border: 1px solid #a2a2a2; height: 2rem; line-height: 2rem; text-align: left; font-size: 0.8rem; color: #757575">
            <option value="" disabled selected hidden>Jenis Pelatihan</option>
            <option>Online</option>
            <option>Offline</option>
            <option>Hybrid</option>
        </select>
        <!-- Select: Kesulitan -->
        <select class="border rounded-md text-center focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" style="border: 1px solid #a2a2a2; height: 2rem; line-height: 2rem; text-align: left; font-size: 0.8rem; color: #757575;">
            <option value="" disabled selected hidden>Kesulitan</option>
            <option>Dasar</option>
            <option>Menengah</option>
            <option>Lanjutan</option>
        </select>
    </div>

    <!-- Kategori Pelatihan -->
    <div class="container mx-auto mt-16 mb-8" style="width: 90%;">
        <h2 class="text-xl font-bold text-center">Berbagai Macam Kategori Pelatihan:</h2>
    </div>

    <div class="container mx-auto splide" style="width: 90%;">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide text-center">
                    <img src="https://i.pinimg.com/736x/93/ab/0a/93ab0ae21a1be5d6901853a4fce27e7f.jpg" class="h-auto w-40 rounded-md mx-auto">
                    <p class="mt-2 text-gray-700">Teknologi</p>
                </li>
                <li class="splide__slide text-center">
                    <img src="https://i.pinimg.com/736x/a4/03/4f/a4034f3e762d81e259b471e3b2b5906a.jpg" class="h-auto w-40 rounded-md mx-auto">
                    <p class="mt-2 text-gray-700">Ekonomi</p>
                </li>
                <li class="splide__slide text-center">
                    <img src="https://i.pinimg.com/736x/c4/ea/38/c4ea3823b1cc75ff077142540638ed40.jpg" class="h-auto w-40 rounded-md mx-auto">
                    <p class="mt-2 text-gray-700">Fashion</p>
                </li>
                <li class="splide__slide text-center">
                    <img src="https://i.pinimg.com/736x/44/29/45/442945d76703de1272e0a5eb34cdcb55.jpg" class="h-auto w-40 rounded-md mx-auto">
                    <p class="mt-2 text-gray-700">Memasak</p>
                </li>
                <li class="splide__slide text-center">
                    <img src="https://i.pinimg.com/736x/e4/6e/66/e46e6647ebfb1268ebea2d0258eb4b6d.jpg" class="h-auto w-40 rounded-md mx-auto">
                    <p class="mt-2 text-gray-700">Design</p>
                </li>
                <li class="splide__slide text-center">
                    <img src="https://i.pinimg.com/736x/c3/39/9a/c3399a009bba3b3fccb8306dd5d85654.jpg" class="h-auto w-40 rounded-md mx-auto">
                    <p class="mt-2 text-gray-700">Kecantikan</p>
                </li>
            </ul>
        </div>
    </div>

    <!-- Tambahkan script Splide.js -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/css/splide.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var splide = new Splide('.splide', {
                type   : 'loop',
                perPage: 5,
                perMove: 1,
                gap    : '0.1rem', 
                focus  : 'center', 
                pagination: false, 
                arrows: true,
            });

            splide.mount();
        });
    </script>

    <!-- Courses -->
    <div class="container mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 mt-8 mb-4" style="width: 90%;">
        <h2 class="text-xl font-bold">Pelatihan Gratis:</h2>
    </div>
    <div class="container mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4" style="width: 90%;">
        <a href="{{ route('user.course1') }}">
            <div class="bg-white p-4 rounded-md border" style="border: 1px solid #a2a2a2;">
                <img src="https://i.pinimg.com/736x/34/01/ee/3401ee2dbb27776d850e77c6a2bee3d2.jpg" class="h-40 w-auto rounded-md">
                <div class="space-y-4">
                    <div class="flex items-center justify-between mt-4">
                        <h2 class="text-sm font-semibold">Dasar Pemrograman</h2>
                        <div class="text-sm">
                            <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">Offline</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="text-sm text-gray-700 font-medium">50 jam</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        <span class="text-sm text-gray-700 font-medium">Tingkat: Dasar</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-700 font-medium">Kuota: 1000 Peserta</span>
                    </div>                 
                    <div class="mt-4">
                        <p class="text-sm font-medium">Harga</p>
                        <p class="text-lg font-bold">Gratis</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.course2') }}">
            <div class="bg-white p-4 rounded-md border" style="border: 1px solid #a2a2a2;">
                <img src="https://i.pinimg.com/736x/9f/d5/94/9fd5943aa427907cee81950f59ac8f54.jpg" class="h-40 w-auto rounded-md">
                <div class="space-y-4">
                    <div class="flex items-center justify-between mt-4">
                        <h2 class="text-sm font-semibold">Algoritma Pemrograman</h2>
                        <div class="text-sm">
                            <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">Online</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="text-sm text-gray-700 font-medium">50 jam</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        <span class="text-sm text-gray-700 font-medium">Tingkat: Menengah</span>
                    </div>  
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-700 font-medium">Kuota: 1000 Peserta</span>
                    </div>              
                    <div class="mt-4">
                        <p class="text-sm font-medium">Harga</p>
                        <p class="text-lg font-bold">Gratis</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.course3') }}">
            <div class="bg-white p-4 rounded-md border" style="border: 1px solid #a2a2a2;">
                <!-- <div class="h-32 bg-black rounded-md mb-4"></div> -->
                <img src="https://i.pinimg.com/736x/43/0b/5a/430b5adba48d1687ed90bdb7d60e003c.jpg" class="h-40 w-auto rounded-md">
                <div class="space-y-4">
                    <div class="flex items-center justify-between mt-4">
                        <h2 class="text-sm font-semibold">Pemrograman Berbasis Objek</h2>
                        <div class="text-sm">
                            <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">Offline</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="text-sm text-gray-700 font-medium">50 jam</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        <span class="text-sm text-gray-700 font-medium">Tingkat: Lanjutan</span>
                    </div>     
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-700 font-medium">Kuota: 1000 Peserta</span>
                    </div>           
                    <div class="mt-4">
                        <p class="text-sm font-medium">Harga</p>
                        <p class="text-lg font-bold">Gratis</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.course3') }}">
            <div class="bg-white p-4 rounded-md border" style="border: 1px solid #a2a2a2;">
                <!-- <div class="h-32 bg-black rounded-md mb-4"></div> -->
                <img src="https://i.pinimg.com/736x/c0/28/3a/c0283a69e08ace9c6ff5adfaac0bbf63.jpg" class="h-40 w-auto rounded-md">
                <div class="space-y-4">
                    <div class="flex items-center justify-between mt-4">
                        <h2 class="text-sm font-semibold">Jaringan Komputer</h2>
                        <div class="text-sm">
                            <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">Offline</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="text-sm text-gray-700 font-medium">50 jam</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        <span class="text-sm text-gray-700 font-medium">Tingkat: Dasar</span>
                    </div>     
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-700 font-medium">Kuota: 1000 Peserta</span>
                    </div>           
                    <div class="mt-4">
                        <p class="text-sm font-medium">Harga</p>
                        <p class="text-lg font-bold">Gratis</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</body>
</html>