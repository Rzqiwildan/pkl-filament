<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-black">
    <div class="container mx-auto p-8">
        <div class="bg-white p-6 rounded shadow-md">
            <h1 class="text-2xl font-bold mb-4">Hasil Quiz</h1>
            <p class="text-lg">Skor Anda: {{ $score }} dari {{ $totalQuestions }}</p>

            <p class="text-lg">
                @if($score >= $passingScore)
                    Selamat, Anda lulus!
                @else
                    Maaf, Anda tidak lulus. Cobalah lagi.
                @endif
            </p>

            <div class="mt-6">
                <a href="{{ route('sertifikat.show') }}" class="text-blue-500">Unduh Sertifikat</a>
                <br>
                <a href="{{ route('quiz.ulangi') }}" class="mt-2 text-green-500">Ulangi Quiz</a>
            </div>
        </div>
    </div>
</body>
</html>
