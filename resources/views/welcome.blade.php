<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>D-STEP</title>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/css/splide.min.css">
    @include('components.navbarWelcome')
</head>

<body>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Carousel -->
    <div class="container mx-auto mt-24" style="width: 90%;">
        <div class="splide_banner rounded-md"
            style="width: 100%; max-height: 12rem; overflow: hidden; position: relative;">
            <div class="splide__track" style="width: 100%; height: 100%;">
                <ul class="splide__list" style="margin: 0; padding: 0; display: flex;">
                    @foreach ($banners as $banner)
                        <li class="splide__slide" style="flex: 0 0 100%; text-align: center;">
                            <a href="{{ route('banner3.show', $banner->id) }}">
                                <img src="{{ Storage::url($banner->cover_banner) }}"
                                    style="width: 100%; height: auto; object-fit: cover;" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="container mx-auto mt-8 flex space-x-4 mb-8" style="width: 90%;">
        <!-- Input -->
        <input type="text" id="search-input" placeholder="Cari pelatihan, lokasi pelatihan, dll"
            class="p-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
            style="width: 30%; border: 1px solid #a2a2a2; height: 2rem; line-height: 2rem; text-align: left; font-size: 0.875rem;" />

        <!-- Tempat menampilkan hasil pencarian -->
        <div id="autocomplete-results" class="absolute bg-white border rounded-md mt-8 shadow-lg hidden"
            style="overflow-y: auto; max-height: 200px; width: 20%; border: 1px solid #a2a2a2; height: 4rem; line-height: 1rem; font-size: 0.875rem;">
        </div>

        <!-- Select: Jenis Pelatihan -->
        <select id="jenis-filter"
            class="border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
            style="border: 1px solid #a2a2a2; height: 2rem; line-height: 2rem; text-align: left; font-size: 0.8rem; color: #757575">
            <option value="" disabled selected hidden>Jenis Pelatihan</option>
            <option value="online">Online</option>
            <option value="offline">Offline</option>
            <option value="hybrid">Hybrid</option>
        </select>

        <!-- Select: Kesulitan -->
        <select id="kesulitan-filter"
            class="border rounded-md text-center focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
            style="border: 1px solid #a2a2a2; height: 2rem; line-height: 2rem; text-align: left; font-size: 0.8rem; color: #757575;">
            <option value="" disabled selected hidden>Kesulitan</option>
            <option value="dasar">Dasar</option>
            <option value="menengah">Menengah</option>
            <option value="lanjutan">Lanjutan</option>
        </select>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("search-input");
            const resultsContainer = document.getElementById("autocomplete-results");
            const jenisFilter = document.getElementById("jenis-filter");
            const kesulitanFilter = document.getElementById("kesulitan-filter");

            // Fungsi untuk fetch data berdasarkan input & filter
            function fetchPelatihan() {
                const query = searchInput.value.trim();
                const jenis = jenisFilter.value;
                const kesulitan = kesulitanFilter.value;

                // Bangun URL dengan parameter
                const url =
                    `/search-pelatihan?query=${encodeURIComponent(query)}&jenis=${jenis}&kesulitan=${kesulitan}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log("API Response:", data); // Debug

                        resultsContainer.innerHTML = "";

                        if (data.length === 0) {
                            resultsContainer.classList.add("hidden");
                            resultsContainer.style.display = "none";
                            return;
                        }

                        data.forEach(item => {
                            const div = document.createElement("div");
                            div.textContent = item.name; // Pastikan 'name' sesuai field di DB
                            div.classList.add("p-2", "hover:bg-gray-200", "cursor-pointer");

                            div.addEventListener("click", function() {
                                searchInput.value = item.name;
                                resultsContainer.classList.add("hidden");
                                resultsContainer.style.display = "none";
                            });

                            resultsContainer.appendChild(div);
                        });

                        resultsContainer.classList.remove("hidden");
                        resultsContainer.style.display = "block";
                    })
                    .catch(error => console.error("Fetch Error:", error));
            }

            // Event listeners
            searchInput.addEventListener("input", fetchPelatihan);
            jenisFilter.addEventListener("change", fetchPelatihan);
            kesulitanFilter.addEventListener("change", fetchPelatihan);

            // Tekan Enter langsung arahkan ke halaman hasil
            searchInput.addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    const query = searchInput.value.trim();
                    const jenis = jenisFilter.value;
                    const kesulitan = kesulitanFilter.value;

                    if (query.length > 0 || jenis || kesulitan) {
                        const searchURL =
                            `/hasil-pencarian?query=${encodeURIComponent(query)}&jenis=${jenis}&kesulitan=${kesulitan}`;
                        window.location.href = searchURL;
                    }
                }
            });

            // Sembunyikan hasil ketika klik di luar dropdown
            document.addEventListener("click", function(event) {
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
                            <img src="{{ Storage::url($categorie->image) }}" class="h-auto w-32 rounded-md mx-auto">
                            <p class="mt-2 text-gray-700">{{ $categorie->name }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var categoryCount = {{ count($categories) }};
            var splide = new Splide('.splide', {
                type: 'loop',
                perPage: categoryCount > 5 ? 5 : categoryCount,
                perMove: 1,
                gap: '0.1rem',
                focus: 'center',
                pagination: false,
                arrows: true,
            });

            splide.mount();
        });
    </script>

    <!-- Courses -->
    <div class="container mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 mt-8 mb-4" style="width: 90%;">
        <h2 class="text-xl font-bold">Pelatihan Tersedia:</h2>
    </div>
    <div id="pelatihan-container"
        class="container mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4" style="width: 90%;">
        @foreach ($pelatihans as $pelatihan)
            @if ($pelatihan->getRemainingTimeAttribute() !== 'Sudah Berakhir')
                <a href="{{ route('course1.show', $pelatihan->id) }}">
                    <div class="bg-white p-4 rounded-md border" style="border: 1px solid #a2a2a2;">
                        <img src="{{ Storage::url($pelatihan->photos->first()->photo ?? 'default.jpg') }}"
                            class="h-40 w-auto rounded-md">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between mt-4">
                                <h2 class="text-sm font-semibold">{{ $pelatihan->name }}</h2>
                                <div class="text-sm">
                                    <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full"
                                        style="border: 1px solid #1E40AF">{{ $pelatihan->jenis }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span
                                    class="text-sm text-gray-700 font-medium">{{ $pelatihan->getRemainingTimeAttribute() }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                </svg>
                                <span class="text-sm text-gray-700 font-medium">Tingkat:
                                    {{ $pelatihan->kesulitan }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if ($pelatihan->kapasitas > 0)
                                    <span class="text-sm text-gray-700 font-medium">Kuota: {{ $pelatihan->kapasitas }}
                                        Peserta</span>
                                @else
                                    <span class="text-sm text-red-600 font-medium">Kuota Pelatihan Sudah Terisi
                                        Penuh</span>
                                @endif
                            </div>
                            <div class="mt-4">
                                <p class="text-sm font-medium">Harga</p>
                                <p class="text-lg font-bold">Rp {{ number_format($pelatihan->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
</body>

</html>
