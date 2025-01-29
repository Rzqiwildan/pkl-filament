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
        <h1 class="text-xl font-bold">Pelatihan Terdaftar</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 max-w-3xl">
        <!-- Detail Pelatihan -->
        <div class="col-span-1 border rounded-lg p-4" style="border: 1px solid #a2a2a2;">
            <div class="flex items-center justify-between border-b border-gray-400 mb-8">
                <h2 class="text-lg font-bold mb-4">Dasar Pemrograman</h2>
                <div class="text-sm mb-4">
                    <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full" style="border: 1px solid #1E40AF">Offline</span>
                </div>
            </div>
            
            <div class="flex items-start space-x-4">
                <img src="https://i.pinimg.com/736x/2a/29/bd/2a29bdac0443c22be5023b94cea79e89.jpg" class="w-16 h-20 rounded-md mb-8 mr-8">
                <div>
                    <p class="font-medium mb-4">UPT Perpustakaan dan UNDIP Press</p>
                    <p class="text-sm text-gray-600">
                        Jl. Prof. Soedarto SH, Tembalang, Kec. Tembalang, Kota Semarang, Jawa Tengah 50275
                    </p>
                    <a href="https://maps.app.goo.gl/qbk6nmfRNckJwXEd6" target="_blank" class="text-blue-500 text-sm" style="text-decoration: underline;">Lihat di Google Maps</a>
                </div>
            </div>
        </div>

    <!-- Jadwal Pelatihan -->
    <div class="border rounded-lg mt-6 p-6 max-w-3xl" style="border: 1px solid #a2a2a2;">
        <h2 class="text-lg font-semibold mb-4">Jadwal Pelatihan</h2>
        <div class="flex justify-between items-center bg-blue-50 border mb-4 px-4 py-2 rounded-lg" style="border: 1px solid #1E40AF;">
            <span>14 Jan 2025 - 14 Mar 2025</span>
            <span class="font-semibold">999 kuota tersedia</span>
        </div>
    </div>
</div>
</body>