<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="bg-gray-100">
    @include('components.navbar')
    <div class="container mx-auto mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4" style="width: 90%;">
        <h2 class="text-xl font-bold mt-4">Pelatihan Kategori {{ $categories->name }}:</h2>
    </div>
    <div class="container mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4" style="width: 90%;">
    @foreach ($pelatihans as $pelatihan)
        @foreach($pelatihan->photos as $photo)
            <a href="{{ route('course1.show', $pelatihan->id) }}">
            <div class="bg-white p-4 rounded-md border" style="border: 1px solid #a2a2a2;">
                <img src="{{ asset($photo->photo) }}" class="h-40 w-auto rounded-md">
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