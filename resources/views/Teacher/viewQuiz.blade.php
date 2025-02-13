<title>Detail Quiz - {{ $quiz->title }}</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('components.navbarTeacher')

<div class="bg-gray-100">
    <div class="container mx-auto px-4 py-8 mt-16">
        <h1 class="text-3xl font-bold">Detail Quiz - {{ $quiz->title }}</h1>
        <p class="text-gray-600 mt-2">{{ $quiz->description ?? 'Tidak ada deskripsi' }}</p>
        <p class="text-gray-700 mt-2 font-semibold">Durasi: {{ $quiz->duration }} menit</p>

        <!-- List Pertanyaan -->
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <h2 class="text-xl font-semibold mb-3">Daftar Pertanyaan</h2>
            @forelse ($quiz->questions as $question)
                <div class="mb-4 p-4 border rounded-md">
                    <p class="font-semibold">{{ $loop->iteration }}. {{ $question->question }}</p>
                    <ul class="mt-2">
                        @foreach ($question->choices as $choice)
                            <li class="{{ $choice->is_correct ? 'text-green-600 font-semibold' : '' }}">
                                {{ $choice->choice_text }}
                            </li>
                        @endforeach
                    </ul>
                    <!-- Tombol Edit Soal -->
                    <a href="{{ route('teacher.editQuestion', ['quizId' => $quiz->id, 'questionId' => $question->id]) }}"
                        class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition inline-block mt-2">
                        Edit Soal
                    </a>
                </div>
            @empty
                <p class="text-gray-500">Belum ada pertanyaan dalam quiz ini.</p>
            @endforelse
        </div>

        <!-- Form Tambah Pertanyaan -->
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <h2 class="text-xl font-semibold mb-3">Tambah Pertanyaan</h2>
            <form action="{{ route('teacher.storeQuestion', ['quizId' => $quiz->id]) }}" method="POST">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pertanyaan</label>
                    <input type="text" name="question" class="w-full p-2 border rounded-md" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Pilihan Jawaban</label>
                    @for ($i = 0; $i < 4; $i++)
                        <div class="flex items-center space-x-2 mt-2">
                            <input type="text" name="choices[{{ $i }}][choice_text]"
                                class="w-full p-2 border rounded-md" required>
                            <input type="radio" name="correct_choice" value="{{ $i }}">
                        </div>
                    @endfor
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 mt-4 rounded-md hover:bg-blue-700 transition">
                    Tambah Pertanyaan
                </button>
            </form>
        </div>
    </div>
    @include('components.footer')
</div>
