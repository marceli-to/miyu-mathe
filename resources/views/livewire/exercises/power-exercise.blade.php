<div class="space-y-8">
    {{-- Mode Selection --}}
    <div class="bg-white rounded-2xl border border-stone-200 p-6 md:p-8">
        <h2 class="text-xl font-semibold text-stone-900 mb-4">Aufgabentyp wählen</h2>
        <div class="flex flex-wrap gap-3">
            <button
                wire:click="setMode('write_as_power')"
                class="px-5 py-3 rounded-lg border-2 transition-all cursor-pointer {{ $mode === 'write_as_power' ? 'border-terracotta-500 bg-terracotta-50 text-terracotta-700' : 'border-stone-200 bg-white text-stone-700 hover:border-stone-300' }}"
            >
                Schreibe als Potenz
            </button>
            <button
                wire:click="setMode('expand')"
                class="px-5 py-3 rounded-lg border-2 transition-all cursor-pointer {{ $mode === 'expand' ? 'border-terracotta-500 bg-terracotta-50 text-terracotta-700' : 'border-stone-200 bg-white text-stone-700 hover:border-stone-300' }}"
            >
                Schreibe ausführlich
            </button>
            <button
                wire:click="setMode('calculate')"
                class="px-5 py-3 rounded-lg border-2 transition-all cursor-pointer {{ $mode === 'calculate' ? 'border-terracotta-500 bg-terracotta-50 text-terracotta-700' : 'border-stone-200 bg-white text-stone-700 hover:border-stone-300' }}"
            >
                Berechne
            </button>
        </div>
    </div>

    {{-- Exercises --}}
    <div class="bg-white rounded-2xl border border-stone-200 p-6 md:p-8">
        <h2 class="text-2xl font-semibold text-stone-900 mb-2">
            @if($mode === 'write_as_power')
                Schreibe als Potenz
            @elseif($mode === 'expand')
                Schreibe ausführlich (ohne zu rechnen)
            @else
                Berechne
            @endif
        </h2>
        <p class="text-stone-600 mb-8">Fülle alle Felder aus und klicke auf "Prüfen".</p>

        <div class="space-y-5">
            @foreach($exercises as $index => $exercise)
                <div class="flex items-center gap-4 border-b-2 border-b-stone-200 pb-4">
                    <span class="text-stone-500 font-medium w-8">{{ chr(97 + $index) }})</span>
                    @if($mode === 'write_as_power')
                        <span class="text-xl font-mono text-stone-800 w-1/2">{{ $exercise['display'] }}</span>
                        <div class="flex gap-x-8 items-center">
                          <span class="text-xl text-stone-400">=</span>
                          <div class="inline-flex gap-x-2 items-start">
                              <input
                                  type="number"
                                  wire:model="answers.{{ $index }}.base"
                                  class="w-16 h-12 text-center text-xl font-mono border-2 rounded-lg focus:outline-none transition-colors {{ $showResults ? ($results[$index] ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50') : 'border-stone-300 focus:border-terracotta-500' }}"
                                                                >
                              <input
                                  type="number"
                                  wire:model="answers.{{ $index }}.exponent"
                                  class="w-10 h-8 text-center text-base font-mono border-2 rounded-md focus:outline-none transition-colors -ml-1 -mt-2 {{ $showResults ? ($results[$index] ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50') : 'border-stone-300 focus:border-terracotta-500' }}"
                                                                >
                          </div>
                        </div>
                    @elseif($mode === 'expand')
                        <div class="w-16 text-xl font-mono text-stone-800">
                            {{ $exercise['base'] }}<sup class="text-base">{{ $exercise['exponent'] }}</sup>
                        </div>
                        <span class="text-xl text-stone-400">=</span>
                        <input
                            type="text"
                            wire:model="answers.{{ $index }}.value"
                            class="w-64 h-12 px-4 text-lg font-mono border-2 rounded-lg focus:outline-none transition-colors {{ $showResults ? ($results[$index] ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50') : 'border-stone-300 focus:border-terracotta-500' }}"
                            placeholder="z.B. 6 × 6 × 6"
                        >
                    @else
                        <div class="w-16 text-xl font-mono text-stone-800">
                            {{ $exercise['base'] }}<sup class="text-base">{{ $exercise['exponent'] }}</sup>
                        </div>
                        <span class="text-xl text-stone-400">=</span>
                        <input
                            type="number"
                            wire:model="answers.{{ $index }}.value"
                            class="w-32 h-12 text-center text-xl font-mono border-2 rounded-lg focus:outline-none transition-colors {{ $showResults ? ($results[$index] ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50') : 'border-stone-300 focus:border-terracotta-500' }}"
                                                    >
                    @endif

                    @if($showResults)
                        @if($results[$index])
                            <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
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
