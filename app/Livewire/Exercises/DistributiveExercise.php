<?php

namespace App\Livewire\Exercises;

use Livewire\Component;

class DistributiveExercise extends Component
{
    public array $exercises = [];
    public array $answers = [];
    public array $results = [];
    public bool $showResults = false;

    // Predefined distributive law exercises with blanks
    // Each exercise has parts with text and blanks to fill
    protected array $problemSet = [
        [
            'parts' => [
                ['text' => '3 × (4 + 5) = '],
                ['blank' => true, 'answer' => 3],
                ['text' => ' × 4 + 3 × '],
                ['blank' => true, 'answer' => 5],
                ['text' => ' = 12 + 15 = 27'],
            ],
        ],
        [
            'parts' => [
                ['text' => '(24 - 20) : 4 = 24 : '],
                ['blank' => true, 'answer' => 4],
                ['text' => ' - 20 : '],
                ['blank' => true, 'answer' => 4],
                ['text' => ' = 6 - 5 = '],
                ['blank' => true, 'answer' => 1],
            ],
        ],
        [
            'parts' => [
                ['text' => '('],
                ['blank' => true, 'answer' => 5],
                ['text' => ' + 3) × 4 = 5 × '],
                ['blank' => true, 'answer' => 4],
                ['text' => ' + '],
                ['blank' => true, 'answer' => 3],
                ['text' => ' × 4 = '],
                ['blank' => true, 'answer' => 20],
                ['text' => ' + 12 = '],
                ['blank' => true, 'answer' => 32],
            ],
        ],
        [
            'parts' => [
                ['text' => '('],
                ['blank' => true, 'answer' => 12],
                ['text' => ' + 15) : 3 = '],
                ['blank' => true, 'answer' => 12],
                ['text' => ' : 3 + 15 : '],
                ['blank' => true, 'answer' => 3],
                ['text' => ' = 4 + '],
                ['blank' => true, 'answer' => 5],
                ['text' => ' = 9'],
            ],
        ],
        [
            'parts' => [
                ['text' => '5 × (6 + 2) = '],
                ['blank' => true, 'answer' => 5],
                ['text' => ' × 6 + '],
                ['blank' => true, 'answer' => 5],
                ['text' => ' × 2 = 30 + 10 = '],
                ['blank' => true, 'answer' => 40],
            ],
        ],
        [
            'parts' => [
                ['text' => '(18 + 12) : 6 = 18 : '],
                ['blank' => true, 'answer' => 6],
                ['text' => ' + 12 : '],
                ['blank' => true, 'answer' => 6],
                ['text' => ' = '],
                ['blank' => true, 'answer' => 3],
                ['text' => ' + 2 = '],
                ['blank' => true, 'answer' => 5],
            ],
        ],
        [
            'parts' => [
                ['text' => '4 × ('],
                ['blank' => true, 'answer' => 7],
                ['text' => ' + 3) = 4 × 7 + 4 × '],
                ['blank' => true, 'answer' => 3],
                ['text' => ' = '],
                ['blank' => true, 'answer' => 28],
                ['text' => ' + 12 = '],
                ['blank' => true, 'answer' => 40],
            ],
        ],
        [
            'parts' => [
                ['text' => '(36 - 24) : '],
                ['blank' => true, 'answer' => 4],
                ['text' => ' = 36 : 4 - 24 : 4 = '],
                ['blank' => true, 'answer' => 9],
                ['text' => ' - '],
                ['blank' => true, 'answer' => 6],
                ['text' => ' = 3'],
            ],
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

        foreach ($selected as $exerciseIndex => $exercise) {
            $blankIndex = 0;
            $processedParts = [];

            foreach ($exercise['parts'] as $part) {
                if (isset($part['blank']) && $part['blank']) {
                    $processedParts[] = [
                        'blank' => true,
                        'answer' => $part['answer'],
                        'blankIndex' => $blankIndex,
                    ];
                    $this->answers[$exerciseIndex][$blankIndex] = '';
                    $blankIndex++;
                } else {
                    $processedParts[] = ['text' => $part['text']];
                }
            }

            $this->exercises[$exerciseIndex] = ['parts' => $processedParts];
        }
    }

    public function checkAnswers()
    {
        $this->results = [];

        foreach ($this->exercises as $exerciseIndex => $exercise) {
            $allCorrect = true;
            $partResults = [];

            foreach ($exercise['parts'] as $part) {
                if (isset($part['blank']) && $part['blank']) {
                    $blankIndex = $part['blankIndex'];
                    $userAnswer = trim($this->answers[$exerciseIndex][$blankIndex] ?? '');
                    $isCorrect = (int)$userAnswer === $part['answer'];
                    $partResults[$blankIndex] = $isCorrect;
                    if (!$isCorrect) {
                        $allCorrect = false;
                    }
                }
            }

            $this->results[$exerciseIndex] = [
                'allCorrect' => $allCorrect,
                'parts' => $partResults,
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
        return view('livewire.exercises.distributive-exercise');
    }
}
