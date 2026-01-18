<?php

namespace App\Livewire\Exercises;

use Livewire\Component;

class SimplifyBracketsExercise extends Component
{
    public array $exercises = [];
    public array $answers = [];
    public array $results = [];
    public bool $showResults = false;

    // Exercises with too many brackets - need to simplify and calculate
    protected array $problemSet = [
        [
            'expression' => '((3 × 4) + 2) × 5',
            'simplified' => '(3 × 4 + 2) × 5',
            'answer' => 70,
        ],
        [
            'expression' => '(12 : (6 : 3)) - (16 : 4)',
            'simplified' => '12 : (6 : 3) - 16 : 4',
            'answer' => 2,
        ],
        [
            'expression' => '((48 : 6) × 3) + (3 × (4 + 5))',
            'simplified' => '48 : 6 × 3 + 3 × (4 + 5)',
            'answer' => 51,
        ],
        [
            'expression' => '((5 + 3) × 2) + (4 × 3)',
            'simplified' => '(5 + 3) × 2 + 4 × 3',
            'answer' => 28,
        ],
        [
            'expression' => '(24 : (4 × 2)) + ((6 + 2) × 3)',
            'simplified' => '24 : (4 × 2) + (6 + 2) × 3',
            'answer' => 27,
        ],
        [
            'expression' => '((7 × 6) - (8 × 4)) + (5 × 2)',
            'simplified' => '7 × 6 - 8 × 4 + 5 × 2',
            'answer' => 20,
        ],
        [
            'expression' => '((36 : 6) + (4 × 2)) × 2',
            'simplified' => '(36 : 6 + 4 × 2) × 2',
            'answer' => 28,
        ],
        [
            'expression' => '(5 × (6 + 4)) - ((8 × 3) + 2)',
            'simplified' => '5 × (6 + 4) - (8 × 3 + 2)',
            'answer' => 24,
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
            $this->answers[$index] = ['simplified' => '', 'result' => ''];
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
        return view('livewire.exercises.simplify-brackets-exercise');
    }
}
