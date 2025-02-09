<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pelatihan Anda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    @include('components.navbarTeacher')

    <div class="container mx-auto mt-24" style="width: 90%;">
        <h2 class="text-xl font-bold">Pelatihan yang Anda Ajarkan</h2>
    </div>

    <div class="container mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4" style="width: 90%;">
        @forelse ($pelatihans as $pelatihan)
            @if ($pelatihan->photos->isNotEmpty())
                <a
                    href="{{ route(
                        auth()->user()->hasRegistered($pelatihan->id)
                            ? ($pelatihan->jenis == 'online'
                                ? 'online.show'
                                : 'offline.show')
                            : 'teacher.uploadMateri',
                        $pelatihan->id,
                    ) }}">
                    <div class="bg-white p-4 rounded-md border" style="border: 1px solid #a2a2a2;">
                        <img src="{{ Storage::url($pelatihan->photos->first()->photo) }}"
                            class="h-40 w-auto rounded-md">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between mt-4">
                                <h2 class="text-sm font-semibold">{{ $pelatihan->name }}</h2>
                                <div class="text-sm">
                                    <span class="text-[#1E40AF] font-medium py-1 px-2 rounded-full"
                                        style="border: 1px solid #1E40AF">{{ $pelatihan->jenis }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-cgrey-0 font-medium">Tingkat:
                                    {{ $pelatihan->kesulitan }}</span>
                            </div>
                            {{-- <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-700 font-medium">Kuota: {{ $pelatihan->kapasitas }}
                                        Peserta</span>
                                </div> --}}
                        </div>
                    </div>
                </a>
            @endif
        @empty
            <p class="text-gray-500">Anda belum mengikuti pelatihan apa pun.</p>
        @endforelse
    </div>

    @include('components.footer')
</body>

</html>
