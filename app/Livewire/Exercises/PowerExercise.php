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

        for ($i = 0; $i < 5; $i++) {
            $base = rand(2, 12);
            $exponent = rand(2, 5);
            
            if ($this->mode === 'write_as_power') {
                // "Schreibe als Potenz" - Convert multiplication to power notation
                $display = implode(' × ', array_fill(0, $exponent, $base));
                $this->exercises[] = ['display' => $display, 'base' => $base, 'exponent' => $exponent];
            } elseif ($this->mode === 'expand') {
                // "Schreibe ausführlich" - Expand power notation without calculating
                $answer = implode(' × ', array_fill(0, $exponent, $base));
                $this->exercises[] = ['base' => $base, 'exponent' => $exponent, 'answer' => $answer];
            } else {
                // "Berechne" - Calculate the result
                $answer = pow($base, $exponent);
                $this->exercises[] = ['base' => $base, 'exponent' => $exponent, 'answer' => $answer];
            }
            
            $this->answers[$i] = ['base' => '', 'exponent' => '', 'value' => ''];
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
