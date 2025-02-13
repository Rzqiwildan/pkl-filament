<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D-STEP - Quiz</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-black">
    @include('components.navbar')

    <div class="flex min-h-screen mt-16">
        <!-- Sidebar -->
        <div class="w-1/4 bg-white p-4 border-r">
            <h2 class="text-xl font-bold mb-4">Daftar Soal</h2>
            <div class="grid grid-cols-5 gap-2">
                @foreach($questions as $index => $question)
                    <button 
                        class="w-12 h-12 border rounded flex items-center justify-center soal-btn 
                        {{ $currentQuestionIndex == $index ? 'bg-blue-500 text-white' : (isset($answers[$index]) ? 'bg-gray-300' : 'bg-white') }}" 
                        onclick="navigateToQuestion({{ $index }})">
                        {{ $index + 1 }}
                    </button>
                @endforeach
            </div>
            <!-- Timer -->
            <div class="mt-6 p-4 border rounded bg-gray-100">
                <h3 class="font-bold">Sisa Waktu:</h3>
                <p id="timer" class="text-2xl text-red-500">{{ gmdate("i:s", $remainingTime) }}</p>
            </div>
        </div>

        <!-- Soal Section -->
        <div class="w-3/4 p-6">
            <h2 class="text-lg font-semibold mb-4">{{ $currentQuestion->question }}</h2>
            <form action="{{ route('quiz.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="current_question_index" value="{{ $currentQuestionIndex }}">
                @foreach($currentQuestion->choices as $choice)
                    @php
                        // Ambil jawaban dari session agar tetap tercentang jika halaman direfresh
                        $savedAnswers = session("answers_$quiz->id", []);
                        $isChecked = isset($savedAnswers[$currentQuestionIndex]) && $savedAnswers[$currentQuestionIndex] == $choice->id;
                    @endphp
                    <label class="block mb-2">
                        <input type="radio" name="answer" value="{{ $choice->id }}" {{ $isChecked ? 'checked' : '' }} required> 
                        {{ $choice->choice_text }}
                    </label>
                @endforeach
                <div class="mt-4 flex {{ $currentQuestionIndex > 0 ? 'justify-between' : 'justify-end' }}">
                    @if($currentQuestionIndex > 0)
                        <a href="{{ route('quiz.soal', ['quiz_id' => $quiz->id, 'question' => $currentQuestionIndex - 1]) }}" 
                        class="px-4 py-2 bg-gray-300 rounded">
                            Sebelumnya
                        </a>
                    @endif
                    <button type="submit" name="action" value="{{ $currentQuestionIndex < count($questions) - 1 ? 'next' : 'finish' }}" 
                            class="px-4 py-2 {{ $currentQuestionIndex < count($questions) - 1 ? 'bg-blue-500' : 'bg-green-500' }} text-white rounded">
                        {{ $currentQuestionIndex < count($questions) - 1 ? 'Selanjutnya' : 'Selesai' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        let currentQuestionIndex = {{ $currentQuestionIndex }};
        const totalQuestions = {{ count($questions) }};
        
        function navigateToQuestion(index) {
            document.getElementById('next_question').value = index;
            document.getElementById('quizForm').submit();
        }

        document.querySelectorAll('.answer-option').forEach((radio) => {
            radio.addEventListener('change', function () {
                fetch("{{ route('quiz.saveAnswer') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        question_index: this.dataset.questionIndex,
                        answer: this.value
                    })
                }).then(response => response.json())
                .then(data => console.log('Jawaban disimpan:', data));
            });
        });

        document.getElementById('nextBtn')?.addEventListener('click', () => {
            if (currentQuestionIndex < totalQuestions - 1) {
                currentQuestionIndex++;
                document.getElementById('next_question').value = currentQuestionIndex;
                document.getElementById('quizForm').submit();
            }
        });

        document.getElementById('finishBtn')?.addEventListener('click', () => {
            document.getElementById('quizForm').action = "{{ route('quiz.hasil', ['quiz_id' => $quiz->id]) }}";
            document.getElementById('quizForm').submit();
        });

        let timerElement = document.getElementById('timer');
        let totalSeconds = {{ $remainingTime }};

        function updateTimer() {
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            if (totalSeconds <= 0) {
                document.getElementById('quizForm').submit();
            } else {
                totalSeconds--;
                setTimeout(updateTimer, 1000);
            }
        }

        updateTimer();
    </script>
</body>
</html>
