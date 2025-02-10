<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Quiz extends Component
{
    public $questions = [];
    public $currentQuestionIndex = 0;
    public $answers = [];
    public $score = 0;  // Mendeklarasikan $score sebagai public
    public $passed = false;

    public function mount()
    {
        $this->questions = [
            ['question' => 'Apa ibu kota Indonesia?', 'options' => ['Jakarta', 'Bandung', 'Surabaya', 'Medan'], 'correct_answer' => 0],
            ['question' => 'Siapa presiden pertama Indonesia?', 'options' => ['Sukarno', 'Soeharto', 'Habibie', 'Jokowi'], 'correct_answer' => 0],
        ];
    }

    public function next()
    {
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
        }
    }

    public function prev()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }

    public function finish()
    {
        $this->score = 0;

        foreach ($this->answers as $index => $answer) {
            if ($this->questions[$index]['correct_answer'] == $answer) {
                $this->score++;
            }
        }

        $this->passed = $this->score >= 2;
    }

    public function resetQuiz()
    {
        $this->score = 0;
        $this->passed = false;
        $this->answers = [];
        $this->currentQuestionIndex = 0;
    }

    public function render()
    {
        return view('livewire.quiz');  // Pastikan view ini ada
    }
}
