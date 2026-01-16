<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Miyu - Mathe lernen' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-stone-50 min-h-screen antialiased">
    <div class="min-h-screen flex flex-col">
        <header>
            <div class="max-w-4xl mx-auto px-6 py-6">
                <div class="flex items-center justify-between">
                    <a href="/" class="text-2xl md:text-3xl font-semibold text-stone-800 tracking-tight">Start</a>
                    <nav class="flex items-center gap-4 md:gap-6">
                        <a href="/potenz" class="text-stone-600 hover:text-stone-900 transition-colors text-sm md:text-base">Potenzen</a>
                        <a href="/vergleichen" class="text-stone-600 hover:text-stone-900 transition-colors text-sm md:text-base">Vergleichen</a>
                        <a href="/stellenwert" class="text-stone-600 hover:text-stone-900 transition-colors text-sm md:text-base">Stellenwert</a>
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-1 py-6 md:py-12">
            <div class="max-w-4xl mx-auto px-4 md:px-6">
                {{ $slot }}
            </div>
        </main>

        <footer>
            <div class="flex items-center justify-center font-mono py-3 text-[.65rem] text-stone-400">
                <span>Mathe lernen mit Miyu</span>
            </div>
        </footer>
    </div>

    @livewireScripts
</body>
</html>
