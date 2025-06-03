<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('components.navbar')
</head>
<body>
    <div class="container mx-auto mt-24" style="width: 90%;">
        <img src="{{ Storage::url($banner->rincian_banner) }}" style="width: 100%; height: 100%; object-fit: cover;"/>
    </div>

    <!-- Wrapper for the button to center it vertically -->
    <div class="flex items-center justify-center mb-8" style="height: 100px;">
    <a href="{{ route(
        $pelatihan->jenis == 'online'
            ? (auth()->user()->hasRegistered($pelatihan->id) ? 'online.show' : 'course1.show')
            : 'offline.show',
        $pelatihan->id
    ) }}">
        <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">
            Lihat Detail Pelatihan
        </button>
    </a>

    </div>
</body>
</html>

                