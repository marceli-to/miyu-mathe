<?php

namespace App\Livewire\Exercises;

use Livewire\Component;

class PowerExercise extends Component
{
    public array $exercises = [];
    public array $answers = [];
    public array $results = [];
    public string $mode = 'write_as_power'; // write_as_power, expand, calculate
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

        if ($this->mode === 'write_as_power') {
            // "Schreibe als Potenz" - Convert multiplication to power notation
            $this->exercises = [
                ['display' => '5 × 5 × 5 × 5', 'base' => 5, 'exponent' => 4],
                ['display' => '2 × 2 × 2 × 2 × 2 × 2', 'base' => 2, 'exponent' => 6],
                ['display' => '9 × 9', 'base' => 9, 'exponent' => 2],
                ['display' => '4 × 4 × 4', 'base' => 4, 'exponent' => 3],
                ['display' => '10 × 10 × 10 × 10 × 10', 'base' => 10, 'exponent' => 5],
            ];
        } elseif ($this->mode === 'expand') {
            // "Schreibe ausführlich" - Expand power notation without calculating
            $this->exercises = [
                ['base' => 6, 'exponent' => 3, 'answer' => '6 × 6 × 6'],
                ['base' => 2, 'exponent' => 5, 'answer' => '2 × 2 × 2 × 2 × 2'],
                ['base' => 8, 'exponent' => 2, 'answer' => '8 × 8'],
                ['base' => 3, 'exponent' => 4, 'answer' => '3 × 3 × 3 × 3'],
                ['base' => 11, 'exponent' => 3, 'answer' => '11 × 11 × 11'],
            ];
        } else {
            // "Berechne" - Calculate the result
            $this->exercises = [
                ['base' => 2, 'exponent' => 4, 'answer' => 16],
                ['base' => 5, 'exponent' => 2, 'answer' => 25],
                ['base' => 3, 'exponent' => 3, 'answer' => 27],
                ['base' => 10, 'exponent' => 3, 'answer' => 1000],
                ['base' => 4, 'exponent' => 3, 'answer' => 64],
            ];
        }

        foreach ($this->exercises as $index => $exercise) {
            $this->answers[$index] = ['base' => '', 'exponent' => '', 'value' => ''];
        }
    }

    public function setMode(string $mode)
    {
        $this->mode = $mode;
        $this->generateExercises();
    }

    public function checkAnswers()
    {
        $this->results = [];

        foreach ($this->exercises as $index => $exercise) {
            if ($this->mode === 'write_as_power') {
                $baseCorrect = (int)($this->answers[$index]['base'] ?? 0) === $exercise['base'];
                $exponentCorrect = (int)($this->answers[$index]['exponent'] ?? 0) === $exercise['exponent'];
                $this->results[$index] = $baseCorrect && $exponentCorrect;
            } elseif ($this->mode === 'expand') {
                $userAnswer = trim($this->answers[$index]['value'] ?? '');
                $userAnswer = str_replace(['*', 'x', 'X'], '×', $userAnswer);
                $userAnswer = preg_replace('/\s+/', ' ', $userAnswer);
                $this->results[$index] = strtolower($userAnswer) === strtolower($exercise['answer']);
            } else {
                $this->results[$index] = (int)($this->answers[$index]['value'] ?? 0) === $exercise['answer'];
            }
        }

        $this->showResults = true;
    }

    public function newExercises()
    {
        $this->generateExercises();
    }

    public function render()
    {
        return view('livewire.exercises.power-exercise');
    }
}
