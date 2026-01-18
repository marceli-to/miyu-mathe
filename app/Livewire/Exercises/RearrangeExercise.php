<?php

namespace App\Livewire\Exercises;

use Livewire\Component;

class RearrangeExercise extends Component
{
    public array $exercises = [];
    public array $answers = [];
    public array $results = [];
    public bool $showResults = false;

    // Predefined exercises that benefit from rearranging
    protected array $problemSet = [
        ['expression' => '172 + 34 + 28', 'answer' => 234, 'hint' => '172 + 28 = 200'],
        ['expression' => '212 - 77 - 12', 'answer' => 123, 'hint' => '212 - 12 = 200'],
        ['expression' => '39 × 5 : 13', 'answer' => 15, 'hint' => '39 : 13 = 3'],
        ['expression' => '5 × 44 × 2', 'answer' => 440, 'hint' => '5 × 2 = 10'],
        ['expression' => '128 : 16 : 2', 'answer' => 4, 'hint' => '128 : 2 = 64'],
        ['expression' => '133 + 28 - 23', 'answer' => 138, 'hint' => '133 - 23 = 110'],
        ['expression' => '45 + 78 + 55', 'answer' => 178, 'hint' => '45 + 55 = 100'],
        ['expression' => '324 - 89 - 24', 'answer' => 211, 'hint' => '324 - 24 = 300'],
        ['expression' => '25 × 17 × 4', 'answer' => 1700, 'hint' => '25 × 4 = 100'],
        ['expression' => '36 × 5 : 9', 'answer' => 20, 'hint' => '36 : 9 = 4'],
        ['expression' => '64 : 8 : 2', 'answer' => 4, 'hint' => '64 : 8 = 8'],
        ['expression' => '87 + 45 + 13', 'answer' => 145, 'hint' => '87 + 13 = 100'],
        ['expression' => '156 - 43 - 56', 'answer' => 57, 'hint' => '156 - 56 = 100'],
        ['expression' => '8 × 13 × 5', 'answer' => 520, 'hint' => '8 × 5 = 40'],
        ['expression' => '72 : 12 : 3', 'answer' => 2, 'hint' => '72 : 12 = 6'],
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
        return view('livewire.exercises.rearrange-exercise');
    }
}
