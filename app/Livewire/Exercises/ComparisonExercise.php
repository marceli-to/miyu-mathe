<?php

namespace App\Livewire\Exercises;

use Livewire\Component;

class ComparisonExercise extends Component
{
    public array $exercises = [];
    public array $answers = [];
    public array $results = [];
    public bool $showResults = false;

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

        // Power comparison exercises
        $comparisons = [
            ['left' => ['base' => 5, 'exp' => 2], 'right' => ['base' => 3, 'exp' => 3]], // 25 vs 27 -> <
            ['left' => ['base' => 2, 'exp' => 6], 'right' => ['base' => 4, 'exp' => 3]], // 64 vs 64 -> =
            ['left' => ['base' => 10, 'exp' => 2], 'right' => ['base' => 5, 'exp' => 3]], // 100 vs 125 -> <
            ['left' => ['base' => 3, 'exp' => 4], 'right' => ['base' => 9, 'exp' => 2]], // 81 vs 81 -> =
            ['left' => ['base' => 2, 'exp' => 7], 'right' => ['base' => 11, 'exp' => 2]], // 128 vs 121 -> >
            ['left' => ['base' => 6, 'exp' => 3], 'right' => ['base' => 15, 'exp' => 2]], // 216 vs 225 -> <
            ['left' => ['base' => 4, 'exp' => 4], 'right' => ['base' => 16, 'exp' => 2]], // 256 vs 256 -> =
            ['left' => ['base' => 2, 'exp' => 5], 'right' => ['base' => 6, 'exp' => 2]], // 32 vs 36 -> <
            ['left' => ['base' => 7, 'exp' => 2], 'right' => ['base' => 2, 'exp' => 6]], // 49 vs 64 -> <
            ['left' => ['base' => 5, 'exp' => 4], 'right' => ['base' => 25, 'exp' => 2]], // 625 vs 625 -> =
            ['left' => ['base' => 3, 'exp' => 5], 'right' => ['base' => 15, 'exp' => 2]], // 243 vs 225 -> >
            ['left' => ['base' => 8, 'exp' => 2], 'right' => ['base' => 4, 'exp' => 3]], // 64 vs 64 -> =
        ];

        // Shuffle and take 10
        shuffle($comparisons);
        $selected = array_slice($comparisons, 0, 10);

        foreach ($selected as $index => $comp) {
            $leftValue = pow($comp['left']['base'], $comp['left']['exp']);
            $rightValue = pow($comp['right']['base'], $comp['right']['exp']);

            if ($leftValue < $rightValue) {
                $correct = '<';
            } elseif ($leftValue > $rightValue) {
                $correct = '>';
            } else {
                $correct = '=';
            }

            $this->exercises[$index] = [
                'left' => $comp['left'],
                'right' => $comp['right'],
                'leftValue' => $leftValue,
                'rightValue' => $rightValue,
                'correct' => $correct,
            ];
            $this->answers[$index] = '';
        }
    }

    public function setAnswer(int $index, string $answer)
    {
        $this->answers[$index] = $answer;
    }

    public function checkAnswers()
    {
        $this->results = [];

        foreach ($this->exercises as $index => $exercise) {
            $this->results[$index] = ($this->answers[$index] ?? '') === $exercise['correct'];
        }

        $this->showResults = true;
    }

    public function newExercises()
    {
        $this->generateExercises();
    }

    public function render()
    {
        return view('livewire.exercises.comparison-exercise');
    }
}
