<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
@include('components.navbar')
<body class="bg-gray-100">
    <div class="container mx-auto p-6 mt-16">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Pelatihan</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Detail Pelatihan -->
            <div class="col-span-2 border rounded-lg p-4" style="border: 1px solid #a2a2a2;">
                <div class="flex items-center justify-between border-b border-gray-400 mb-8">
                    <h2 class="text-lg font-semibold mb-4">{{ $pelatihans->name }}</h2>
                    <div class="text-sm mb-4">
                        <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">{{ $pelatihans->jenis }}</span>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4">
                    <img src="{{ Storage::url($jadwalPelatihan->image) }}" class="w-16 h-20 rounded-md mb-8 mr-8">
                        <div>
                            <p class="font-medium mb-4">{{ $jadwalPelatihan->location_name }}</p>
                            <p class="text-sm text-gray-600">
                                {{ $jadwalPelatihan->address }}
                            </p>
                            <div class="maps">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.4377353773596!2d110.4381257741071!3d-7.048600869476866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708c3e6c1a6d05%3A0xa5f69b96fddc3e51!2sUPT%20Perpustakaan%20dan%20UNDIP%20Press!5e0!3m2!1sid!2sid!4v1706698660243!5m2!1sid!2sid" 
                            width="200" 
                            height="200" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Pendaftaran -->
        <div class="border rounded-lg p-6" style="border: 1px solid #a2a2a2;">
            <h2 class="text-lg font-semibold mb-8">Ringkasan Pendaftaran</h2>
            <div class="flex justify-between items-center mb-4">
                <span>Biaya Pelatihan</span>
                <span class="font-regular text-green-600">Rp {{ number_format($pelatihans->harga, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center mb-4">
                <span class="font-semibold">Total Pembayaran</span>
                <span class="font-semibold text-green-600">Rp {{ number_format($pelatihans->harga, 0, ',', '.') }}</span>
            </div>
            <form id="form-ikut-pelatihan" action="{{ route('ikut.pelatihan') }}" method="POST">
                @csrf
                <input type="hidden" name="pelatihan_id" value="{{ $pelatihans->id }}">

                @php
                    $isExpired = $pelatihans->jadwalPelatihan->end_date < now(); // Cek apakah pelatihan sudah berakhir
                @endphp

                @if($isExpired)
                    <button type="button" disabled 
                        class="w-full px-4 py-2 font-semibold text-white rounded-md border-none cursor-not-allowed mt-8 mb-4 bg-gray-400">
                        Anda Sudah Mengikuti Pelatihan
                    </button>
                @elseif($pelatihans->harga == 0)
                    <button id="registerButton" type="submit" 
                        class="w-full px-4 py-2 font-semibold text-white rounded-md border-none cursor-pointer mt-8 mb-4 transition duration-300 
                        {{ $isRegistered ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-500 hover:bg-blue-600' }}" 
                        {{ $isRegistered ? 'disabled' : '' }}>
                        {{ $isRegistered ? 'Anda telah terdaftar!' : 'Daftar Sekarang' }}
                    </button>
                @else
                    <button type="button" 
                        onclick="window.location.href='{{ route('payment.show', ['id' => $pelatihans->id]) }}'" 
                        class="bg-blue-500 text-white font-semibold w-full px-4 py-2 rounded-md border-none cursor-pointer mt-8 mb-4 transition duration-300 hover:bg-blue-600">
                        Daftar dan Bayar
                    </button>
                @endif
            </form>


            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const button = document.getElementById("registerButton");

                    // Event listener untuk menangani submit form
                    const form = document.getElementById('form-ikut-pelatihan');
                    form.addEventListener('submit', function(e) {
                        e.preventDefault(); // Mencegah form dari submit biasa
                        fetch('/ikut-pelatihan', {
                            method: 'POST',
                            body: new FormData(form), // Mengirimkan data form
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Menyertakan token CSRF
                            }
                        });
                    });
                });
            </script>

            <!-- Overlay gelap -->
            <div id="overlay" class="fixed inset-0 w-full h-full bg-black bg-opacity-60 z-[1000] hidden"></div>

            <!-- Elemen notifikasi -->
            <div id="notification" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gray-100 text-gray-800 p-5 rounded-xl text-center w-72 z-[1010] hidden">
                <div id="iconContainer" class="flex justify-center mb-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div class="mb-4 mt-4">
                    <p>Anda Berhasil Mendaftar Pelatihan!</p>
                </div>
                <button id="closeButton" class="bg-blue-500 text-white border-none rounded-md px-4 py-2 cursor-pointer mt-2 hover:bg-blue-600">
                    Oke
                </button>
            </div>

            <script>
                const overlay = document.getElementById("overlay");
                const notification = document.getElementById("notification");
                const closeButton = document.getElementById("closeButton");
                const registerButton = document.getElementById("registerButton");

                // Saat tombol "Daftar Sekarang" ditekan
                registerButton.addEventListener("click", () => {
                    overlay.classList.remove("hidden"); // Tampilkan overlay
                    notification.classList.remove("hidden"); // Tampilkan notifikasi
                });

                // Saat tombol "Oke" ditekan
                closeButton.addEventListener("click", () => {
                    overlay.classList.add("hidden"); // Sembunyikan overlay
                    notification.classList.add("hidden"); // Sembunyikan notifikasi

                    // Ubah tombol "Daftar Sekarang" jadi "Anda telah terdaftar!"
                    registerButton.textContent = "Anda telah terdaftar!";
                    registerButton.classList.add("bg-gray-400", "cursor-not-allowed");
                    registerButton.classList.remove("bg-blue-500", "hover:bg-blue-600");
                    registerButton.disabled = true;
                });
            </script>
        </div>
    </div>

    <!-- Jadwal Pelatihan -->
    <div class="border rounded-lg mt-6 p-6" style="border: 1px solid #a2a2a2;">
        <h2 class="text-lg font-semibold mb-4">Jadwal Pelatihan</h2>
        <div class="flex justify-between items-center bg-blue-50 border mb-4 px-4 py-2 rounded-lg" style="border: 1px solid #1E40AF;">
            <span>
                {{ \Carbon\Carbon::parse($jadwalPelatihan->start_date)->format('d M Y') }} - 
                {{ \Carbon\Carbon::parse($jadwalPelatihan->end_date)->format('d M Y') }}
            </span>
            @php
                $isExpired = $pelatihans->jadwalPelatihan->end_date < now(); // Cek apakah pelatihan sudah berakhir
            @endphp
            @if(!$isExpired)
                <span class="font-semibold">{{ $pelatihans->kapasitas }} kuota tersedia</span>
            @endif
        </div>
    </div>
    <!-- Dropdown Rincian Jadwal -->
    <div x-data="{ open: false }" class="mt-4 mb-4 bg-gray-100 rounded-lg border" style="border: 1px solid #a2a2a2;">
    <button @click="open = !open" class="w-full text-left px-4 py-3 text-lg font-semibold hover:bg-gray-200 rounded-lg flex justify-between items-center">
        <div class="mt-2 mb-2">
            Rincian Jadwal Pelatihan
        </div>
        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>
        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 15.75-7.5-7.5-7.5 7.5" />
        </svg>
    </button>

    <div x-show="open" class="px-4 py-2 space-y-2">
        <div class="flex items-center space-x-2 mt-4 mb-4">
            
            <!-- <span>Pengenalan Algoritma Pemrograman</span> -->
            <!-- Tautan ke PDF -->
    <span class="hover:text-blue-500 hover:underline cursor-pointer" 
        onclick="openPDF('{{ asset('storage/' . $jadwalPelatihan->jadwal) }}')">
        {{ $jadwalPelatihan->jadwal }}
    </span>

    <!-- Modal untuk PDF -->
    <div id="pdfModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white w-3/4 h-3/4 p-4 relative">
            <button onclick="closePDF()" class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded">Tutup</button>
            <iframe id="pdfViewer" class="w-full h-full"></iframe>
        </div>
    </div>

    <script>
    function openPDF(pdfUrl) {
        document.getElementById("pdfViewer").src = pdfUrl;
        document.getElementById("pdfModal").classList.remove("hidden");
    }

    function closePDF() {
        document.getElementById("pdfModal").classList.add("hidden");
        document.getElementById("pdfViewer").src = "";
    }
    </script>
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
</body>
</html>
