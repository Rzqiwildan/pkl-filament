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
    <div class="container mx-auto px-4 py-8 mt-16">
        <!-- Header Section -->
        <div class="flex items-start justify-between mb-4">
        <!-- Teks di Samping Kanan -->
            <div class="w-2/3">
                <h1 class="text-3xl font-bold">{{ $pelatihans->name }}</h1>
                <p class="text-gray-600 mt-2">
                    {{ $pelatihans->deskripsi }}
                </p>
            </div>
        </div>

    <!-- Course Details -->
    <div class="flex items-center space-x-4">
        <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span class="text-gray-600 text-sm">{{$pelatihans->remaining_time}}</span>
        </div>
        <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
            <span class="text-gray-600 text-sm">Tingkat: {{ $pelatihans->kesulitan }}</span>
        </div> 
        <p class="text-sm text-gray-600 flex items-center">
            <span class="mr-2">Kuota: {{ $pelatihans->kapasitas }} Peserta</span>
        </p>
        <div class="text-sm">
            <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">{{ $pelatihans->jenis }}</span>
        </div>
     </div>

        <!-- Course Content -->
        <div class="mt-6">
            <!-- Dropdown Bagian 1 -->
            <div x-data="{ open: false }" class="mb-4 bg-gray-100 rounded-lg border" style="border: 1px solid #a2a2a2;">
                <button @click="open = !open"
                    class="w-full text-left px-4 py-3 text-lg font-semibold hover:bg-gray-200 rounded-lg flex justify-between items-center">
                    <div class="mt-2 mb-2">
                        Bagian 1
                    </div>
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 15.75-7.5-7.5-7.5 7.5" />
                    </svg>
                </button>

                <div x-show="open" class="px-4 py-2 space-y-2">
                    <div class="flex items-center space-x-2 mt-4 mb-4">

                        <!-- <span>Pengenalan Algoritma Pemrograman</span> -->
                        <a href="https://youtu.be/RadjAh0LT9I?si=18so-viuYNTMb2DS" target="_blank"
                            class="text-sm text-gray-900">
                            <span class="bg-black text-white rounded-full px-3 py-1 text-xs font-semibold">Video</span>
                            <span class="hover:text-blue-500 hover:underline">Pengenalan Algoritma Pemrograman</span>
                        </a>
                    </div>
                </div>
            </div>

        <!-- Dropdown Bagian 2 -->
        <div x-data="{ open: false }" class="mb-4 bg-gray-100 rounded-lg border" style="border: 1px solid #a2a2a2;">
            <button @click="open = !open" class="w-full text-left px-4 py-3 text-lg font-semibold hover:bg-gray-200 rounded-lg flex justify-between items-center">
                <div class="mt-2 mb-2">
                    Bagian 2
                </div>
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 15.75-7.5-7.5-7.5 7.5" />
                </svg>
            </button>
            <div x-show="open" class="px-4 py-2 space-y-2">
                <div class="flex items-center space-x-2">
                    <span class="bg-black text-white rounded-full px-3 py-1 text-xs font-semibold mt-4 mb-4">Video</span>
                    <span class="mt-4 mb-4">Logika pemrograman dasar</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="bg-black text-white rounded-full px-3 py-1 text-xs font-semibold mb-4">Video</span>
                    <span class="mb-4">Memahami pseudocode: cara menulis logika tanpa kode</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="bg-black text-white rounded-full px-3 py-1 text-xs font-semibold mb-4">Video</span>
                    <span class=" mb-4">Flowchart: representasi visual algoritma</span>
                </div>
                <div class="flex items-center space-x-2 mb-4">
    <a href="{{ route('quiz.soal') }}" class="mb-4 text-blue-600 hover:underline">Quiz 1</a>
</div>

            </div>
        </div>

            <!-- Dropdown Bagian 3 -->
            <div x-data="{ open: false }" class="mb-4 bg-gray-100 rounded-lg border"
                style="border: 1px solid #a2a2a2;">
                <button @click="open = !open"
                    class="w-full text-left px-4 py-3 text-lg font-semibold hover:bg-gray-200 rounded-lg flex justify-between items-center">
                    <div class="mt-2 mb-2">
                        Bagian 3
                    </div>
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 15.75-7.5-7.5-7.5 7.5" />
                    </svg>
                </button>
                <div x-show="open" class="px-4 py-2 space-y-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <span
                            class="bg-black text-white rounded-full px-3 py-1 text-xs font-semibold mt-4 mb-4">Video</span>
                        <span class="mt-4 mb-4">Struktur Dasar Algoritma: Urutan (Sequence)</span>
                    </div>
                    <div class="flex items-center space-x-2 mb-4">
                        <span
                            class="bg-black text-white rounded-full px-3 py-1 text-xs font-semibold mb-4">Video</span>
                        <span class="mb-4">Struktur Dasar Algoritma: Percabangan (Selection)</span>
                    </div>
                    <div class="flex items-center space-x-2 mb-4">
                        <span
                            class="bg-black text-white rounded-full px-3 py-1 text-xs font-semibold mb-4">Video</span>
                        <span class="mb-4">Struktur Dasar Algoritma: Perulangan (Looping)</span>
                    </div>
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="bg-black text-white rounded-full px-3 py-1 text-xs font-semibold mb-4">Quiz</span>
                        <span class="mb-4">Quiz 2</span>
                    </div>
                </div>
            </div>
            <!-- Dropdown Evaluasi Akhir -->
            <div x-data="{ open: false }" class="mb-4 bg-gray-100 rounded-lg border"
                style="border: 1px solid #a2a2a2;">
                <button @click="open = !open"
                    class="w-full text-left px-4 py-3 text-lg font-semibold hover:bg-gray-200 rounded-lg flex justify-between items-center">
                    <div class="mt-2 mb-2">
                        Evaluasi Akhir
                    </div>
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 15.75-7.5-7.5-7.5 7.5" />
                    </svg>
                </button>

                <div x-show="open" class="px-4 py-2 space-y-2">
                    <div class="flex items-center space-x-2">
                        <span
                            class="bg-black text-white rounded-full px-3 py-1 text-xs font-semibold mt-4 mb-4">Evaluasi</span>
                        <span class="mt-4 mb-4">Evaluasi Akhir</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
</body>
