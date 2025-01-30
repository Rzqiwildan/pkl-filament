<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>D-STEP</title>
</head>
<body>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('components.navbar')
    <!-- Carousel -->
    <div class="container mx-auto mt-24" style="width: 90%;">
        <div class="splide_banner rounded-md" style="width: 100%; max-height: 12rem; overflow: hidden; position: relative;">
            <div class="splide__track" style="width: 100%; height: 100%;">
                <ul class="splide__list" style="margin: 0; padding: 0; display: flex;">
                @foreach ($banners as $banner)
                    <li class="splide__slide" style="flex: 0 0 100%; text-align: center;">
                        <a href="{{ route('banner3.show', $banner->id) }}">
                            <img src="{{ Storage::url($banner->cover_banner) }}" style="width: 100%; height: auto; object-fit: cover;"/>
                        </a>
                    </li>
                @endforeach
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
        <input type="text" id="search-input" placeholder="Cari pelatihan, lokasi pelatihan, dll" class="p-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" style="width: 30%; border: 1px solid #a2a2a2; height: 2rem; line-height: 2rem; text-align: left; font-size: 0.875rem; color: #000000"/>
        <!-- Tempat menampilkan hasil pencarian -->
        <div id="autocomplete-results" class="absolute bg-white border rounded-md mt-8 shadow-lg hidden" style=" overflow-y: auto; max-height: 200px; width: 20%; border: 1px solid #a2a2a2; height: 4rem; line-height: 1rem; font-size: 0.875rem;"></div>
        <!-- Select: Jenis Pelatihan -->
        <select class="border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" style="border: 1px solid #a2a2a2; height: 2rem; line-height: 2rem; text-align: left; font-size: 0.8rem; color: #757575">
            <option value="" disabled selected hidden>Jenis Pelatihan</option>
            @foreach ($jenisOptions as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <!-- Select: Kesulitan -->
        <select class="border rounded-md text-center focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" style="border: 1px solid #a2a2a2; height: 2rem; line-height: 2rem; text-align: left; font-size: 0.8rem; color: #757575;">
            <option value="" disabled selected hidden>Kesulitan</option>
            @foreach ($kesulitanOptions as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("search-input");
        const resultsContainer = document.getElementById("autocomplete-results");

        searchInput.addEventListener("input", function () {
            let query = this.value.trim();
            if (query.length < 0) {
                resultsContainer.classList.add("hidden");
                return;
            }

            fetch(`/search-pelatihan?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    console.log("API Response:", data); // Debugging API

                    resultsContainer.innerHTML = ""; // Bersihkan hasil sebelumnya

                    if (data.length === 0) {
                        resultsContainer.classList.add("hidden");
                        return;
                    }

                    data.forEach(item => {
                        let div = document.createElement("div");
                        div.textContent = item.name; // Pastikan pakai 'name' bukan 'nama'
                        div.classList.add("p-2", "hover:bg-gray-200", "cursor-pointer");

                        div.addEventListener("click", function () {
                            searchInput.value = item.name;
                            resultsContainer.classList.add("hidden");
                        });

                        resultsContainer.appendChild(div);
                    });

                    resultsContainer.classList.remove("hidden");
                    resultsContainer.style.display = "block"; // Pastikan dropdown terlihat
                })
                .catch(error => console.error("Fetch Error:", error));
        });

        // Arahkan ke halaman hasil pencarian ketika tekan Enter
        searchInput.addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                let query = searchInput.value.trim();
                if (query.length > 0) {
                    window.location.href = `/hasil-pencarian?query=${encodeURIComponent(query)}`;
                }
            }
        });

        // Sembunyikan dropdown kalau klik di luar
        document.addEventListener("click", function (event) {
            if (!resultsContainer.contains(event.target) && event.target !== searchInput) {
                resultsContainer.classList.add("hidden");
                resultsContainer.style.display = "none";
            }
        });
    });
    </script>

    <!-- Kategori Pelatihan -->
    <div class="container mx-auto mt-16 mb-8" style="width: 90%;">
        <h2 class="text-xl font-bold">Berbagai Macam Kategori Pelatihan:</h2>
    </div>

    <div class="container mx-auto splide" style="width: 90%;">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach ($categories as $categorie)
                <li class="splide__slide text-center">
                    <a href="{{ route('kategori.show', $categorie->id) }}">
                        <img src="{{ Storage::url($categorie->image) }}" class="h-auto w-32 rounded-md mx-auto"> <!-- Sesuaikan ukuran gambar -->
                        <p class="mt-2 text-gray-700">{{ $categorie->name }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

    <!-- Tambahkan script Splide.js -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/css/splide.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var categoryCount = {{ count($categories) }};  // Mengambil jumlah kategori dari database
            var splide = new Splide('.splide', {
                type   : 'loop',        // Loop kategori
                perPage: categoryCount > 5 ? 5 : categoryCount,  // Menampilkan kategori sesuai jumlah data (maksimal 5)
                perMove: 1,             // Memindahkan 1 kategori per klik
                gap    : '0.1rem',      // Mengatur gap antar kategori (kurangin jadi 0.5rem atau sesuai selera)
                focus  : 'center',      // Fokus pada kategori tengah
                pagination: false,       // Menampilkan pagination
                arrows: true,           // Menampilkan tombol navigasi
            });

            splide.mount();
        });
    </script>

    <!-- Courses -->
    <div class="container mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 mt-8 mb-4" style="width: 90%;">
        <h2 class="text-xl font-bold">Pelatihan Gratis:</h2>
    </div>
    <div class="container mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4" style="width: 90%;">
        @foreach ($pelatihans as $pelatihan)
            @foreach($pelatihan->photos as $photo)
            <a href="{{ route(
            ($pelatihan->jenis == 'online' && auth()->user()->hasRegistered($pelatihan->id)) 
            ? 'online.show' 
            : 'offline.show', 
            $pelatihan->id) }}">
                <div class="bg-white p-4 rounded-md border" style="border: 1px solid #a2a2a2;">
                    <img src="{{ Storage::url($photo->photo) }}" class="h-40 w-auto rounded-md">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between mt-4">
                            <h2 class="text-sm font-semibold">{{ $pelatihan->name }}</h2>
                            <div class="text-sm">
                                <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">{{ $pelatihan->jenis }}</span>
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
                            <span class="text-sm text-gray-700 font-medium">Tingkat: {{ $pelatihan->kesulitan }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-700 font-medium">Kuota: {{ $pelatihan->kapasitas }} Peserta</span>
                        </div>                 
                        <div class="mt-4">
                            <p class="text-sm font-medium">Harga</p>
                            <p class="text-lg font-bold">Rp {{ number_format($pelatihan->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach    
        @endforeach
    </div>
</body>
<footer class="bg-gray-900 text-white py-6">
    <div class="container mx-auto px-4" style="width: 90%;">
        <div>
            <h3 class="text-lg font-semibold">UPT Perpustakaan dan Undip Press</h3>
            <p class="mt-2 text-sm">
                Jl. Prof Sudarto, SH Gedung Widya Puraya, Tembalang,<br>
                Semarang 024 – 7460042, NPP: 3374102D1000001
            </p>
            <p class="mt-2 text-sm">
                Email: <a href="mailto:perpustakaanundip@gmail.com" class="text-blue-400 hover:underline">perpustakaanundip@gmail.com</a>
            </p>
        </div>
    </div>
</footer>
</html>