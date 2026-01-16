<?php

namespace App\Livewire\Exercises;

use Livewire\Component;

class PlaceValueExercise extends Component
{
    public array $puzzles = [];
    public array $answers = [];
    public array $results = [];
    public bool $showResults = false;

    public function mount()
    {
        $this->generatePuzzles();
    }

    public function generatePuzzles()
    {
        $this->puzzles = [];
        $this->answers = [];
        $this->results = [];
        $this->showResults = false;

        // Generate 3 puzzles with 4x4 grids
        // Formula: Cell(row, col) = base + col*x + row*y (0-indexed)
        for ($i = 0; $i < 3; $i++) {
            $puzzle = $this->generateSinglePuzzle();
            $this->puzzles[$i] = $puzzle;
            $this->answers[$i] = ['x' => '', 'y' => ''];
        }
    }

    private function generateSinglePuzzle(): array
    {
        $gridSize = 4;
        
        // Pick random x (horizontal step), y (vertical step), and base value
        $x = rand(2, 8);
        $y = rand(2, 8);
        $base = rand(1, 20);
        
        // Build the full grid: Cell(row, col) = base + col*x + invertedRow*y
        // x-axis: columns left to right (col 0 = left)
        // y-axis: rows bottom to top (row 3 in array = bottom = y=0, row 0 in array = top = y=3)
        $fullGrid = [];
        for ($row = 0; $row < $gridSize; $row++) {
            $fullGrid[$row] = [];
            for ($col = 0; $col < $gridSize; $col++) {
                $invertedRow = $gridSize - 1 - $row;
                $fullGrid[$row][$col] = $base + $col * $x + $invertedRow * $y;
            }
        }
        
        // Create display grid with hidden cells (null)
        // Minimum for solvability: 2 values in same row (to find x) + 1 value in same column but different row (to find y)
        $displayGrid = array_fill(0, $gridSize, array_fill(0, $gridSize, null));
        
        // Pick a row to show 2 values (for solving x)
        $rowForX = rand(0, $gridSize - 1);
        $cols = range(0, $gridSize - 1);
        shuffle($cols);
        $col1 = $cols[0];
        $col2 = $cols[1];
        // Ensure at least 1 column gap between the two visible cells
        while (abs($col1 - $col2) < 2) {
            shuffle($cols);
            $col1 = $cols[0];
            $col2 = $cols[1];
        }
        
        // Pick a different row to show 1 value in the same column as one of the above (for solving y)
        // Ensure at least 1 row gap
        $otherRows = array_filter(range(0, $gridSize - 1), fn($r) => abs($r - $rowForX) >= 2);
        if (empty($otherRows)) {
            $otherRows = array_diff(range(0, $gridSize - 1), [$rowForX]);
        }
        $rowForY = $otherRows[array_rand($otherRows)];
        $colForY = rand(0, 1) === 0 ? $col1 : $col2;
        
        // Place the 3 required visible cells
        $displayGrid[$rowForX][$col1] = $fullGrid[$rowForX][$col1];
        $displayGrid[$rowForX][$col2] = $fullGrid[$rowForX][$col2];
        $displayGrid[$rowForY][$colForY] = $fullGrid[$rowForY][$colForY];
        
        return [
            'grid' => $displayGrid,
            'correctX' => $x,
            'correctY' => $y,
        ];
    }

    public function checkAnswers()
    {
        $this->results = [];

        foreach ($this->puzzles as $index => $puzzle) {
            $xCorrect = (int)($this->answers[$index]['x'] ?? -1) === $puzzle['correctX'];
            $yCorrect = (int)($this->answers[$index]['y'] ?? -1) === $puzzle['correctY'];
            $this->results[$index] = [
                'x' => $xCorrect,
                'y' => $yCorrect,
                'both' => $xCorrect && $yCorrect
            ];
        }

        $this->showResults = true;
    }

    public function newPuzzles()
    {
        $this->generatePuzzles();
    }

    public function render()
    {
        return view('livewire.exercises.place-value-exercise');
    }
}
