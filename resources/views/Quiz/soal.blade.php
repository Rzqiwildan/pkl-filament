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
            <form id="quizForm" action="{{ route('quiz.submit', ['quiz_id' => $quiz->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                <input type="hidden" name="next_question" id="next_question" value="{{ $currentQuestionIndex }}">

                <div class="mb-4 p-4 border rounded">
                    <p class="text-lg font-bold">{{ $currentQuestion->question }}</p>
                    
                    @foreach($currentQuestion->choices as $choice)
                        <label class="block">
                            <input 
                                type="radio" 
                                name="answer" 
                                value="{{ $choice->id }}" 
                                class="mr-2 answer-option" 
                                data-question-index="{{ $currentQuestionIndex }}"
                                {{ isset($answers[$currentQuestionIndex]) && $answers[$currentQuestionIndex] == $choice->id ? 'checked' : '' }} 
                            />
                            {{ $choice->choice_text }}
                        </label>
                    @endforeach
                </div>

                <div class="flex flex-col items-end space-y-2">
                    <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-1 rounded">Simpan</button>
                    
                    @if ($currentQuestionIndex == count($questions) - 1)
                        <button type="button" id="finishBtn" class="px-4 py-1 bg-red-500 text-white rounded">Selesai</button>
                    @else
                        <button type="button" id="nextBtn" class="px-4 py-1 bg-blue-500 text-white rounded">Selanjutnya</button>
                    @endif
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
