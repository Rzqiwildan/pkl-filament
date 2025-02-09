<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Quiz - {{ $bagian->nama_bagian }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('components.navbarTeacher')
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8 mt-16">
        <h1 class="text-3xl font-bold">Tambah Quiz - {{ $bagian->nama_bagian }}</h1>

        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <h2 class="text-xl font-semibold mb-3">Form Tambah Quiz</h2>
            <form action="{{ route('teacher.storeQuiz', ['bagianId' => $bagian->id]) }}" method="POST">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Quiz</label>
                    <input type="text" name="title" class="w-full p-2 border rounded-md" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                    <textarea name="description" class="w-full p-2 border rounded-md"></textarea>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Durasi (Menit)</label>
                    <input type="number" name="duration" class="w-full p-2 border rounded-md" min="1" required>
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 mt-4 rounded-md hover:bg-blue-700 transition">
                    Simpan Quiz
                </button>
            </form>
        </div>
    </div>
</body>

</html>
