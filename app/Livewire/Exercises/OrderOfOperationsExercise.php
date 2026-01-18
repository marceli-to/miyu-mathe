<?php

namespace App\Livewire\Exercises;

use Livewire\Component;

class OrderOfOperationsExercise extends Component
{
    public array $exercises = [];
    public array $answers = [];
    public array $results = [];
    public bool $showResults = false;

    // Predefined exercises with order of operations
    protected array $problemSet = [
        ['expression' => '3 × 4 + 15 : 3', 'answer' => 17],
        ['expression' => '2 + 3 × 18 - 3', 'answer' => 53],
        ['expression' => '14 - 4 × 2 + 2 × 5', 'answer' => 16],
        ['expression' => '25 : 5 - 4 : 2', 'answer' => 3],
        ['expression' => '28 - 9 × 5 : 3', 'answer' => 13],
        ['expression' => '4 × 8 - 3 × 9 + 3 + 6 × 5', 'answer' => 38],
        ['expression' => '6 + 4 × 5 - 2', 'answer' => 24],
        ['expression' => '18 : 3 + 7 × 2', 'answer' => 20],
        ['expression' => '5 × 6 - 20 : 4', 'answer' => 25],
        ['expression' => '8 + 12 : 4 × 3', 'answer' => 17],
        ['expression' => '36 : 6 + 8 × 2 - 5', 'answer' => 17],
        ['expression' => '7 × 3 - 15 : 5 + 2', 'answer' => 20],
        ['expression' => '48 : 8 + 6 × 3 - 10', 'answer' => 14],
        ['expression' => '9 × 2 + 24 : 6 - 7', 'answer' => 15],
        ['expression' => '5 + 8 × 4 - 16 : 2', 'answer' => 29],
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

        // Shuffle and pick 6 exercises
        $shuffled = $this->problemSet;
        shuffle($shuffled);
        $selected = array_slice($shuffled, 0, 6);

        foreach ($selected as $index => $problem) {
            $this->exercises[$index] = $problem;
            $this->answers[$index] = '';
        }
    }

    public function checkAnswers()
    {
        $this->results = [];

        foreach ($this->exercises as $index => $exercise) {
            $userAnswer = trim($this->answers[$index] ?? '');
            $this->results[$index] = (int)$userAnswer === $exercise['answer'];
        }

        $this->showResults = true;
    }

    public function newExercises()
    {
        $this->generateExercises();
    }

    public function render()
    {
        return view('livewire.exercises.order-of-operations-exercise');
    }
}
