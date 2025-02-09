<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>D-STEP</title>
</head>
@include('components.navbar')
<body class="bg-white text-black">
    <div class="flex min-h-screen mt-16">
        <!-- Sidebar -->
        <div class="w-1/4 bg-white p-4 border-r">
            <h2 class="text-xl font-bold mb-4">Soal</h2>
            <div class="grid grid-cols-5 gap-2">
                @foreach($questions as $index => $question)
                    <button 
                        class="w-12 h-12 border rounded flex items-center justify-center soal-btn 
                        {{ $currentQuestion == $index ? 'bg-blue-500 text-white' : (isset($answers[$index]) ? 'bg-gray-300' : 'bg-white') }}" 
                        data-index="{{ $index }}">
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
            <form id="quizForm" action="{{ route('quiz.submit') }}" method="POST">
                @csrf
                <div class="mb-4 p-4 border rounded">
                    <p class="text-lg font-bold">{{ $questions[$currentQuestion]['question'] }}</p>
                    @foreach($questions[$currentQuestion]['options'] as $option)
                        <label class="block">
                            <input 
                                type="radio" 
                                name="answer" 
                                value="{{ $option }}" 
                                class="mr-2 answer-option" 
                                data-question-index="{{ $currentQuestion }}"
                                {{ isset($answers[$currentQuestion]) && $answers[$currentQuestion] == $option ? 'checked' : '' }} 
                            />
                            {{ $option }}
                        </label>
                    @endforeach
                </div>
                <input type="hidden" name="next_question" id="next_question" value="{{ $currentQuestion }}">
                <div class="flex flex-col items-end space-y-2">
                    <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-1 rounded">Simpan</button>
                    @if ($currentQuestion == count($questions) - 1)
                        <button type="button" id="finishBtn" class="px-4 py-1 bg-red-500 text-white rounded">Selesai</button>
                    @else
                        <button type="button" id="nextBtn" class="px-4 py-1 bg-blue-500 text-white rounded">Selanjutnya</button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentQuestion = {{ $currentQuestion }};
        const totalQuestions = {{ count($questions) }};

        document.querySelectorAll('.answer-option').forEach((radio) => {
            radio.addEventListener('change', function () {
                const answer = this.value;
                const questionIndex = this.dataset.questionIndex;

                fetch("{{ route('quiz.saveAnswer') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        question_index: questionIndex,
                        answer: answer
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Jawaban disimpan:', data);
                });
            });
        });

        // Tombol Selanjutnya
        const nextBtn = document.getElementById('nextBtn');
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                if (currentQuestion < totalQuestions - 1) {
                    currentQuestion++;
                    document.getElementById('next_question').value = currentQuestion;
                    document.getElementById('quizForm').submit();
                }
            });
        }

        // Tombol Selesai
        const finishBtn = document.getElementById('finishBtn');
        if (finishBtn) {
            finishBtn.addEventListener('click', () => {
                const form = document.getElementById('quizForm');
                form.method = "GET"; // Ubah metode menjadi GET
                form.action = "{{ route('quiz.hasil') }}"; 
                form.submit();
            });
        }

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
