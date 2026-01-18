<div class="space-y-8">
    {{-- Instructions --}}
    <div class="bg-white rounded-2xl border border-stone-200 p-6 md:p-8">
        <h2 class="text-2xl font-semibold text-stone-900 mb-2">Stell die Rechnungen um</h2>
        <p class="text-stone-600">Ordne die Rechnung im Kopf so um, dass sie einfacher zu rechnen ist. Gib das Resultat ein.</p>
    </div>

    {{-- Exercises --}}
    <div class="bg-white rounded-2xl border border-stone-200 p-6 md:p-8">
        <div class="space-y-5">
            @foreach($exercises as $index => $exercise)
                <div class="flex items-center gap-4 border-b-2 border-b-stone-200 pb-4">
                    <span class="text-stone-500 font-medium w-8">{{ chr(97 + $index) }})</span>
                    <span class="text-xl font-mono text-stone-800 flex-1">{{ $exercise['expression'] }}</span>
                    <span class="text-xl text-stone-400">=</span>
                    <input
                        type="number"
                        wire:model="answers.{{ $index }}"
                        class="w-24 h-12 text-center text-xl font-mono border-2 rounded-lg focus:outline-none transition-colors {{ $showResults ? ($results[$index] ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50') : 'border-stone-300 focus:border-terracotta-500' }}"
                                            >
                    @if($showResults)
                        @if($results[$index])
                            <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            <div class="flex items-center gap-2">
                                <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span class="text-sm text-stone-500">({{ $exercise['answer'] }})</span>
                            </div>
                        @endif
                    @endif
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
            <div class="mt-6 p-4 rounded-lg {{ collect($results)->every(fn($r) => $r) ? 'bg-green-50 border border-green-200' : 'bg-yellow-50 border border-yellow-200' }}">
                @if(collect($results)->every(fn($r) => $r))
                    <p class="text-green-800 font-medium">Super! Alle Antworten sind richtig!</p>
                @else
                    <p class="text-yellow-800 font-medium">
                        {{ collect($results)->filter()->count() }} von {{ count($results) }} richtig.
                        Versuche es nochmal!
                    </p>
                @endif
            </div>
        @endif
    </div>
</div>
