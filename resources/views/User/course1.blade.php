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
    <div class="container mx-auto py-10 mt-16">
        <div class="rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kiri: Konten utama -->
                <div class="col-span-2">
                    <!-- Header -->
                    <div class="flex justify-between items-center pb-4 border-b border-gray-400">
                        <div>
                            <h1 class="text-2xl font-semibold mb-8">{{ $pelatihans->name }}</h1>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1B86B7" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span class="text-gray-600 text-sm">50 jam</span>
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
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-600 mb-14">
                            <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">{{ $pelatihans->jenis }}</span>
                        </div>
                    </div>

                    <!-- Tentang Pelatihan -->
                    <div class="mb-8 mt-8">
                        <h2 class="text-lg font-semibold mb-2">Tentang Pelatihan</h2>
                        <p class="text-gray-600">
                        {{ $pelatihans->deskripsi }}
                        </p>
                    </div>

                    <!-- Detail -->
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-black">Kemampuan Dasar</h3>
                        <p class="text-gray-600">-</p>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-black">Pengalaman Kerja</h3>
                        <p class="text-gray-600">-</p>
                    </div>
                </div>

                <!-- Kanan: Sidebar -->
                <div class="col-span-1 ml-8">
                    <div class="p-4 rounded-lg border" style="border: 1px solid #a2a2a2;">
                        <div class="mb-8">
                            <p class="text-lg font-medium">Harga</p>
                            <p class="text-2xl font-bold">Rp {{ number_format($pelatihans->harga, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ $pelatihans->jenis === 'offline' ? route('offline.show', $pelatihans->id) : route('online.show', $pelatihans->id) }}">                            <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 w-full rounded-lg mb-8">
                                Ikuti Pelatihan
                            </button>
                        </a>
                        <p class="text-sm text-gray-600 mb-2">Program ini sudah termasuk:</p>
                        <ul class="text-sm text-gray-600 list-disc list-inside mb-4">
                            <li>Sertifikat Mengikuti Pelatihan</li>
                            <li>Bahasa Pengantar: Bahasa Indonesia</li>
                        </ul>
                    </div>
                    <div class="rounded-lg border mt-8" style="border: 1px solid #a2a2a2;">
                    <button class="hover:border-blue-400 border-2 text-grey-400 text-sm font-semibold px-4 py-2 w-full rounded-lg flex items-center w-full justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                            </svg>
                            Bagikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>