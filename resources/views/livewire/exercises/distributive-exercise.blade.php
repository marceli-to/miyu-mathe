<div class="space-y-8">
    {{-- Instructions --}}
    <div class="bg-white rounded-2xl border border-stone-200 p-6 md:p-8">
        <h2 class="text-2xl font-semibold text-stone-900 mb-2">Distributivgesetz</h2>
        <p class="text-stone-600">Fülle die Lücken aus. Das Distributivgesetz: a × (b + c) = a × b + a × c</p>
    </div>

    {{-- Exercises --}}
    <div class="bg-white rounded-2xl border border-stone-200 p-6 md:p-8">
        <div class="space-y-6">
            @foreach($exercises as $exerciseIndex => $exercise)
                <div class="border-b-2 border-b-stone-200 pb-5">
                    <div class="flex items-start gap-4">
                        <span class="text-stone-500 font-medium w-8 pt-2">{{ chr(97 + $exerciseIndex) }})</span>
                        <div class="flex flex-wrap items-center gap-1 text-xl font-mono text-stone-800">
                            @foreach($exercise['parts'] as $part)
                                @if(isset($part['blank']) && $part['blank'])
                                    @php
                                        $blankIndex = $part['blankIndex'];
                                        $isCorrect = $showResults && isset($results[$exerciseIndex]['parts'][$blankIndex]) ? $results[$exerciseIndex]['parts'][$blankIndex] : null;
                                    @endphp
                                    <input
                                        type="number"
                                        wire:model="answers.{{ $exerciseIndex }}.{{ $blankIndex }}"
                                        class="w-14 h-10 text-center text-lg font-mono border-2 rounded-lg focus:outline-none transition-colors {{ $showResults ? ($isCorrect ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50') : 'border-stone-300 focus:border-terracotta-500' }}"
                                                                            >
                                @else
                                    <span class="whitespace-nowrap">{{ $part['text'] }}</span>
                                @endif
                            @endforeach
                        </div>
                        @if($showResults)
                            <div class="shrink-0 pt-2">
                                @if($results[$exerciseIndex]['allCorrect'])
                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex gap-4 mt-8 pt-6">
            <button
                wire:click="checkAnswers"
                class="bg-terracotta-600 hover:bg-terracotta-700 text-white font-medium py-3 px-8 rounded-lg transition-colors cursor-pointer"
            >
                Prüfen
            </button>
            <button
                wire:click="newExercises"
                class="bg-stone-200 hover:bg-stone-300 text-stone-700 font-medium py-3 px-8 rounded-lg transition-colors cursor-pointer"
            >
                Neue Aufgaben
            </button>
        </div>

        @if($showResults)
            @php
                $correctCount = collect($results)->filter(fn($r) => $r['allCorrect'])->count();
                $totalCount = count($results);
            @endphp
            <div class="mt-6 p-4 rounded-lg {{ $correctCount === $totalCount ? 'bg-green-50 border border-green-200' : 'bg-yellow-50 border border-yellow-200' }}">
                @if($correctCount === $totalCount)
                    <p class="text-green-800 font-medium">Super! Alle Antworten sind richtig!</p>
                @else
                    <p class="text-yellow-800 font-medium">
                        {{ $correctCount }} von {{ $totalCount }} richtig.
                        Versuche es nochmal!
                    </p>
                @endif
            </div>
        @endif
    </div>
</div>
