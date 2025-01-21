<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include('components.navbar')
    <!-- Carousel -->
    <div class="container mx-auto mt-24">
        <div class="swiper-container rounded-md overflow-hidden" style="width: 100%; height: 12rem; position: relative;">
            <!-- Wrapper -->
            <div class="swiper-wrapper" style="display: flex; transition: transform 0.3s;">
                <!-- Slide 1 -->
                <div class="swiper-slide" style="flex-shrink: 0; width: 100%; height: 100%;">
                    <img 
                        src="{{ asset('img/banner1.png') }}" 
                        style="width: 100%; height: 100%; object-fit: cover;"
                    />
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide" style="flex-shrink: 0; width: 100%; height: 100%;">
                    <img 
                        src="{{ asset('img/banner2.png') }}" 
                        style="width: 100%; height: 100%; object-fit: cover;"
                    />
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide" style="flex-shrink: 0; width: 100%; height: 100%;">
                    <img 
                        src="{{ asset('img/banner3.png') }}" 
                        style="width: 100%; height: 100%; object-fit: cover;"
                    />
                </div>
                <!-- Slide 4 -->
                <div class="swiper-slide" style="flex-shrink: 0; width: 100%; height: 100%;">
                    <img 
                        src="{{ asset('img/banner2.png') }}" 
                        style="width: 100%; height: 100%; object-fit: cover;"
                    />
                </div>
            </div>
            <!-- Pagination -->
            <div 
                class="swiper-pagination" 
                style="position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); display: flex; gap: 5px;"
            ></div>
            <!-- Navigation -->
            <div 
                class="swiper-button-prev" 
                style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); background-color: #fff; border-radius: 50%; width: 40px; height: 40px; display: flex; justify-content: center; align-items: center; cursor: pointer; border: 2px solid #a2a2a2;"
            >&#x276E;</div>
            <div 
                class="swiper-button-next" 
                style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background-color: #fff; border-radius: 50%; width: 40px; height: 40px; display: flex; justify-content: center; align-items: center; cursor: pointer; border: 2px solid #a2a2a2;"
            >&#x276F;</div>
        </div>
    </div>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Inisialisasi Swiper
        const swiper = new Swiper('.swiper-container', {
            loop: true, 
            autoplay: {
                delay: 3000, 
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true, // Pagination dapat diklik
                renderBullet: function (index, className) {
                    return `<span class="${className}" style="background-color: #2563eb; width: 8px; height: 8px; border-radius: 50%; display: inline-block;"></span>`;
                },
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            on: {
                slideChange: function () {
                    const bullets = document.querySelectorAll('.swiper-pagination span');
                    bullets.forEach((bullet, index) => {
                        if (index === swiper.realIndex) {
                            bullet.style.backgroundColor = '#2563eb'; // Lingkaran biru penuh
                            bullet.style.transform = 'scale(1.2)'; // Membesarkan sedikit untuk penekanan
                        } else {
                            bullet.style.backgroundColor = '#a2a2a2'; // Warna default (abu-abu)
                            bullet.style.transform = 'scale(1)'; // Kembali ke ukuran normal
                        }
                    });
                },
            },
        }); 
    </script>
    <!-- Filters -->
    <div class="container mx-auto mt-8 flex space-x-4 mb-8">
        <!-- Input -->
        <input type="text" placeholder="Cari pelatihan, lokasi pelatihan, dll" class="w-full p-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" style="border: 1px solid #a2a2a2; height: 3rem; line-height: 3rem; text-align: left; font-size: 0.875rem;"/>
        <!-- Select: Jenis Pelatihan -->
        <select class="p-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" style="border: 1px solid #a2a2a2; height: 3rem; line-height: 3rem; text-align: left; font-size: 0.875rem; color: #757575">
            <option value="" disabled selected hidden>Jenis Pelatihan</option>
            <option>Online</option>
            <option>Offline</option>
            <option>Hybrid</option>
        </select>
        <!-- Select: Kesulitan -->
        <select class="p-2 border rounded-md text-center focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" style="border: 1px solid #a2a2a2; height: 3rem; line-height: 3rem; text-align: left; font-size: 0.875rem; color: #757575;">
            <option value="" disabled selected hidden>Kesulitan</option>
            <option>Dasar</option>
            <option>Menengah</option>
            <option>Lanjutan</option>
        </select>
    </div>
    <!-- pilihan kategori -->
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 mb-4">
        <h2 class="text-2xl font-bold">Berbagai Macam Kategori Pelatihan:</h2>
    </div>
    <div class="container mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 mb-4">
        <a href="{{ route('user.course1') }}">
            <div class="bg-white p-4 rounded-md border flex flex-col items-center justify-center" style="border: 1px solid #a2a2a2;">
                <img src="https://i.pinimg.com/736x/93/ab/0a/93ab0ae21a1be5d6901853a4fce27e7f.jpg" class="h-auto w-40 rounded-md">
                <div class="flex items-center justify-between mt-4">
                    <h2 class="text-lg font-semibold">Teknologi</h2>
                </div>
            </div>
        </a>
        <a href="{{ route('user.course1') }}">
            <div class="bg-white p-4 rounded-md border flex flex-col items-center justify-center" style="border: 1px solid #a2a2a2;">
                <img src="https://i.pinimg.com/736x/a4/03/4f/a4034f3e762d81e259b471e3b2b5906a.jpg" class="h-auto w-40 rounded-md">
                <div class="flex items-center justify-between mt-4">
                    <h2 class="text-lg font-semibold">Ekonomi</h2>
                </div>
            </div>
        </a>
        <a href="{{ route('user.course1') }}">
            <div class="bg-white p-4 rounded-md border flex flex-col items-center justify-center" style="border: 1px solid #a2a2a2;">
                <img src="https://i.pinimg.com/736x/c4/ea/38/c4ea3823b1cc75ff077142540638ed40.jpg" class="h-auto w-40 rounded-md">
                <div class="flex items-center justify-between mt-4">
                    <h2 class="text-lg font-semibold">Fashion</h2>
                </div>
            </div>
        </a>
        <a href="{{ route('user.course1') }}">
            <div class="bg-white p-4 rounded-md border flex flex-col items-center justify-center" style="border: 1px solid #a2a2a2;">
                <img src="https://i.pinimg.com/736x/44/29/45/442945d76703de1272e0a5eb34cdcb55.jpg" class="h-auto w-40 rounded-md">
                <div class="flex items-center justify-between mt-4">
                    <h2 class="text-lg font-semibold">Memasak</h2>
                </div>
            </div>
        </a>
        <a href="{{ route('user.course1') }}">
            <div class="bg-white p-4 rounded-md border flex flex-col items-center justify-center" style="border: 1px solid #a2a2a2;">
                <img src="https://i.pinimg.com/736x/99/c0/d5/99c0d54010596d8010479f076f33e7ed.jpg" class="h-auto w-40 rounded-md">
                <div class="flex items-center justify-between mt-4">
                    <h2 class="text-lg font-semibold">Design</h2>
                </div>
            </div>
        </a>
        <a href="{{ route('user.course1') }}">
            <div class="bg-white p-4 rounded-md border flex flex-col items-center justify-center" style="border: 1px solid #a2a2a2;">
                <img src="https://i.pinimg.com/736x/c3/39/9a/c3399a009bba3b3fccb8306dd5d85654.jpg" class="h-auto w-40 rounded-md">
                <div class="flex items-center justify-between mt-4">
                    <h2 class="text-lg font-semibold">Kecantikan</h2>
                </div>
            </div>
        </a>
    </div>
    <!-- Courses -->
    <div class="container mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 mb-4">
        <h2 class="text-2xl font-bold">Pelatihan Gratis:</h2>
    </div>
    <div class="container mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
        <a href="{{ route('user.course1') }}">
            <div class="bg-white p-4 rounded-md border" style="border: 1px solid #a2a2a2;">
                <img src="https://i.pinimg.com/736x/34/01/ee/3401ee2dbb27776d850e77c6a2bee3d2.jpg" class="h-64 w-auto rounded-md">
                <div class="space-y-4">
                    <div class="flex items-center justify-between mt-4">
                        <h2 class="text-lg font-bold">Dasar Pemrograman</h2>
                        <div class="text-sm">
                            <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">Offline</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="text-gray-700 font-medium">50 jam</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        <span class="text-gray-700 font-medium">Tingkat: Dasar</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700 font-medium">Kuota: 1000 Peserta</span>
                    </div>                 
                    <div class="mt-4">
                        <p class="text-lg font-medium">Harga</p>
                        <p class="text-2xl font-bold">Gratis</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.course2') }}">
            <div class="bg-white p-4 rounded-md border" style="border: 1px solid #a2a2a2;">
                <!-- <div class="h-32 bg-black rounded-md mb-4"></div> -->
                <img src="https://i.pinimg.com/736x/9f/d5/94/9fd5943aa427907cee81950f59ac8f54.jpg" class="h-64 w-auto rounded-md">
                <div class="space-y-4">
                    <div class="flex items-center justify-between mt-4">
                        <h2 class="text-lg font-bold">Algoritma Pemrograman</h2>
                        <div class="text-sm">
                            <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">Online</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="text-gray-700 font-medium">50 jam</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        <span class="text-gray-700 font-medium">Tingkat: Menengah</span>
                    </div>  
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700 font-medium">Kuota: 1000 Peserta</span>
                    </div>              
                    <div class="mt-4">
                        <p class="text-lg font-medium">Harga</p>
                        <p class="text-2xl font-bold">Gratis</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.course3') }}">
            <div class="bg-white p-4 rounded-md border" style="border: 1px solid #a2a2a2;">
                <!-- <div class="h-32 bg-black rounded-md mb-4"></div> -->
                <img src="https://i.pinimg.com/736x/43/0b/5a/430b5adba48d1687ed90bdb7d60e003c.jpg" class="h-64 w-auto rounded-md">
                <div class="space-y-4">
                    <div class="flex items-center justify-between mt-4">
                        <h2 class="text-lg font-bold">Pemrograman Berbasis Objek</h2>
                        <div class="text-sm">
                            <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">Offline</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="text-gray-700 font-medium">50 jam</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                        <span class="text-gray-700 font-medium">Tingkat: Lanjutan</span>
                    </div>     
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700 font-medium">Kuota: 1000 Peserta</span>
                    </div>           
                    <div class="mt-4">
                        <p class="text-lg font-medium">Harga</p>
                        <p class="text-2xl font-bold">Gratis</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</body>
</html>