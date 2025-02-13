@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('components.navbarTeacher')

<div class="container mx-auto px-4 mt-8">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold mb-2">Detail Quiz - {{ $quiz->title }}</h2>
        <p class="text-gray-600 mb-6">Durasi: {{ $quiz->duration }} menit</p>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h4 class="text-xl font-semibold mb-6">Daftar Pertanyaan</h4>

            <form method="POST"
                action="{{ route('teacher.updateQuestion', ['quizId' => $quiz->id, 'questionId' => $question->id]) }}">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <input type="text"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('question') border-red-500 @enderror"
                        name="question" value="{{ old('question', $question->question) }}"
                        placeholder="Masukkan pertanyaan">
                    @error('question')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-4">
                    @foreach ($question->choices as $index => $choice)
                        <div class="flex items-center space-x-3">
                            <input type="radio" name="correct_choice" value="{{ $index }}"
                                {{ $choice->is_correct ? 'checked' : '' }}
                                class="w-5 h-5 text-blue-600 focus:ring-blue-500" id="choice_{{ $index }}">
                            <input type="text"
                                class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('choices.' . $index . '.choice_text') border-red-500 @enderror"
                                name="choices[{{ $index }}][choice_text]"
                                value="{{ old('choices.' . $index . '.choice_text', $choice->choice_text) }}"
                                placeholder="Pilihan {{ $index + 1 }}">
                        </div>
                        @error('choices.' . $index . '.choice_text')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    @endforeach
                </div>

                <div class="mt-8 flex space-x-4">
                    <button type="submit"
                        class="px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium">
                        Edit Soal
                    </button>
                    <a href="{{ route('teacher.showQuiz', $quiz->id) }}"
                        class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const correctChoice = document.querySelector('input[name="correct_choice"]:checked');
            if (!correctChoice) {
                e.preventDefault();
                alert('Silakan pilih jawaban yang benar!');
            }
        });
    });
</script>

@include('components.footer')
