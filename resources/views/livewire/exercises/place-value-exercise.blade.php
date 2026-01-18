<div class="space-y-8">
    {{-- Instructions --}}
    <div class="bg-white rounded-2xl border border-stone-200 p-6 md:p-8">
        <h2 class="text-2xl font-semibold text-stone-900 mb-2">Löse</h2>
        <p class="text-stone-600">Finde die Werte für x und y in jedem Rätsel.</p>
    </div>

    {{-- Puzzles --}}
    @foreach($puzzles as $puzzleIndex => $puzzle)
        <div class="bg-white rounded-2xl border border-stone-200 p-6 md:p-8">
            <div class="flex flex-col md:flex-row md:items-start gap-8">
                {{-- Grid with axis labels --}}
                <div class="overflow-x-auto">
                    <div class="flex items-stretch">
                        {{-- Y axis label --}}
                        <div class="flex items-center justify-center pr-2">
                            <span class="text-lg font-medium text-stone-500">y</span>
                        </div>

                        {{-- Grid and X axis --}}
                        <div>
                            {{-- Main grid --}}
                            <table class="border-collapse border-2 border-stone-800">
                                <tbody>
                                    @foreach($puzzle['grid'] as $rowIndex => $row)
                                        <tr>
                                            @foreach($row as $colIndex => $value)
                                                <td class="border border-stone-400 w-12 h-12 text-center font-mono text-lg">
                                                    @if($value !== null)
                                                        <span class="text-stone-800">{{ $value }}</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- X axis label --}}
                            <div class="flex justify-center pt-2">
                                <span class="text-lg font-medium text-stone-500">x</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Answer inputs --}}
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                        <label class="text-xl font-medium text-stone-700 w-8">x =</label>
                        <input
                            type="number"
                            wire:model="answers.{{ $puzzleIndex }}.x"
                            class="w-20 h-12 text-center text-xl font-mono border-2 rounded-lg focus:outline-none transition-colors
                                {{ $showResults
                                    ? ($results[$puzzleIndex]['x'] ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50')
                                    : 'border-stone-300 focus:border-terracotta-500' }}"
                                                    >
                        @if($showResults && !$results[$puzzleIndex]['x'])
                            <span class="text-sm text-red-600">({{ $puzzle['correctX'] }})</span>
                        @elseif($showResults && $results[$puzzleIndex]['x'])
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @endif
                    </div>

                    <div class="flex items-center gap-3">
                        <label class="text-xl font-medium text-stone-700 w-8">y =</label>
                        <input
                            type="number"
                            wire:model="answers.{{ $puzzleIndex }}.y"
                            class="w-20 h-12 text-center text-xl font-mono border-2 rounded-lg focus:outline-none transition-colors
                                {{ $showResults
                                    ? ($results[$puzzleIndex]['y'] ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50')
                                    : 'border-stone-300 focus:border-terracotta-500' }}"
                                                    >
                        @if($showResults && !$results[$puzzleIndex]['y'])
                            <span class="text-sm text-red-600">({{ $puzzle['correctY'] }})</span>
                        @elseif($showResults && $results[$puzzleIndex]['y'])
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Action buttons --}}
    <div class="flex gap-4">
        <button
            wire:click="checkAnswers"
            class="bg-terracotta-600 hover:bg-terracotta-700 text-white font-medium py-3 px-8 rounded-lg transition-colors cursor-pointer"
        >
            Prüfen
        </button>
        <button
            wire:click="newPuzzles"
            class="bg-stone-200 hover:bg-stone-300 text-stone-700 font-medium py-3 px-8 rounded-lg transition-colors cursor-pointer"
        >
            Neue Rätsel
        </button>
    </div>

    @if($showResults)
        @php
            $allCorrect = collect($results)->every(fn($r) => $r['both']);
            $correctCount = collect($results)->filter(fn($r) => $r['both'])->count();
        @endphp
        <div class="p-4 rounded-lg {{ $allCorrect ? 'bg-green-50 border border-green-200' : 'bg-yellow-50 border border-yellow-200' }}">
            @if($allCorrect)
                <p class="text-green-800 font-medium">Super! Alle Rätsel gelöst!</p>
            @else
                <p class="text-yellow-800 font-medium">
                    {{ $correctCount }} von {{ count($results) }} Rätsel richtig gelöst.
                    Versuche es nochmal!
                </p>
            @endif
        </div>
    @endif
</div>
