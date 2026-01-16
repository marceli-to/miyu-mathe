<x-layouts.app>
    <div class="space-y-8">
        {{-- Welcome --}}
        <div class="text-center py-8">
            <h1 class="text-4xl md:text-5xl font-bold text-stone-900 mb-4">Hallo Miyu!</h1>
            <p class="text-lg text-stone-600">Was möchtest du heute üben?</p>
        </div>

        {{-- Exercise Cards --}}
        <div class="grid md:grid-cols-3 gap-6">
            {{-- Powers --}}
            <a href="/potenz" class="group bg-white rounded-2xl border border-stone-200 p-6 hover:border-terracotta-300 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-terracotta-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-terracotta-200 transition-colors">
                    <span class="text-2xl font-bold text-terracotta-600">x<sup>n</sup></span>
                </div>
                <h2 class="text-xl font-semibold text-stone-900 mb-2">Potenzen</h2>
                <p class="text-stone-600 text-sm">Lerne Potenzen zu schreiben, zu erweitern und zu berechnen.</p>
            </a>

            {{-- Comparison --}}
            <a href="/vergleichen" class="group bg-white rounded-2xl border border-stone-200 p-6 hover:border-terracotta-300 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-terracotta-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-terracotta-200 transition-colors">
                    <span class="text-2xl font-bold inline-flex text-terracotta-600"><span>&lt;</span><span>=</span><span>&gt;</span></span>
                </div>
                <h2 class="text-xl font-semibold text-stone-900 mb-2">Vergleichen</h2>
                <p class="text-stone-600 text-sm">Vergleiche Potenzen und finde heraus welche grösser ist.</p>
            </a>

            {{-- Place Value --}}
            <a href="/stellenwert" class="group bg-white rounded-2xl border border-stone-200 p-6 hover:border-terracotta-300 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-terracotta-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-terracotta-200 transition-colors">
                    <svg class="w-8 h-8 text-terracotta-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-stone-900 mb-2">Stellenwert</h2>
                <p class="text-stone-600 text-sm">Löse Stellenwert-Rätsel und finde die fehlenden Zahlen.</p>
            </a>
        </div>

        {{-- Stats or encouragement --}}
        <div class="bg-terracotta-50 rounded-2xl border border-terracotta-200 p-6 md:p-8 text-center">
            <p class="text-terracotta-800">
                Übung macht den Meister! Wähle eine Übung und leg los.
            </p>
        </div>
    </div>
</x-layouts.app>
