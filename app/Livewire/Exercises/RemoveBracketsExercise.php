<?php

namespace App\Livewire\Exercises;

use Livewire\Component;

class RemoveBracketsExercise extends Component
{
    public array $exercises = [];
    public array $answers = [];
    public array $results = [];
    public bool $showResults = false;

    // Exercises about removing brackets while keeping the same result
    protected array $problemSet = [
        [
            'expression' => '16 + (4 + 2)',
            'withoutBrackets' => '16 + 4 + 2',
            'answer' => 22,
        ],
        [
            'expression' => '16 - (4 - 2)',
            'withoutBrackets' => '16 - 4 + 2',
            'answer' => 14,
        ],
        [
            'expression' => '16 × (4 × 2)',
            'withoutBrackets' => '16 × 4 × 2',
            'answer' => 128,
        ],
        [
            'expression' => '16 : (4 : 2)',
            'withoutBrackets' => '16 : 4 × 2',
            'answer' => 8,
        ],
        [
            'expression' => '20 + (5 + 3)',
            'withoutBrackets' => '20 + 5 + 3',
            'answer' => 28,
        ],
        [
            'expression' => '20 - (5 + 3)',
            'withoutBrackets' => '20 - 5 - 3',
            'answer' => 12,
        ],
        [
            'expression' => '30 - (12 - 4)',
            'withoutBrackets' => '30 - 12 + 4',
            'answer' => 22,
        ],
        [
            'expression' => '24 : (6 : 2)',
            'withoutBrackets' => '24 : 6 × 2',
            'answer' => 8,
        ],
        [
            'expression' => '5 × (3 × 4)',
            'withoutBrackets' => '5 × 3 × 4',
            'answer' => 60,
        ],
        [
            'expression' => '48 : (8 : 4)',
            'withoutBrackets' => '48 : 8 × 4',
            'answer' => 24,
        ],
        [
            'expression' => '25 - (10 - 3)',
            'withoutBrackets' => '25 - 10 + 3',
            'answer' => 18,
        ],
        [
            'expression' => '100 - (25 + 15)',
            'withoutBrackets' => '100 - 25 - 15',
            'answer' => 60,
        ],
    ];

    public function mount()
    {
        $this->generateExercises();
    }

    public function generateExercises()
    {
        $this->exercises = [];
        $this->answers = [];
        $this->results = [];
        $this->showResults = false;

        // Shuffle and pick 4 exercises
        $shuffled = $this->problemSet;
        shuffle($shuffled);
        $selected = array_slice($shuffled, 0, 4);

        foreach ($selected as $index => $problem) {
            $this->exercises[$index] = $problem;
            $this->answers[$index] = ['expression' => '', 'result' => ''];
        }
    }

    public function checkAnswers()
    {
        $this->results = [];

        foreach ($this->exercises as $index => $exercise) {
            $userResult = trim($this->answers[$index]['result'] ?? '');
            $resultCorrect = (int)$userResult === $exercise['answer'];

            $this->results[$index] = [
                'resultCorrect' => $resultCorrect,
            ];
        }

        $this->showResults = true;
    }

    public function newExercises()
    {
        $this->generateExercises();
    }

    public function render()
    {
        return view('livewire.exercises.remove-brackets-exercise');
    }
}
