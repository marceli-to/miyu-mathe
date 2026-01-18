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
        @unless(request()->is('/'))
        <header>
            <div class="max-w-4xl mx-auto px-6 pt-4">
                <a href="/" class="inline-flex items-center gap-1 text-stone-600 hover:text-stone-900 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span class="text-base font-medium">Start</span>
                </a>
            </div>
        </header>
        @endunless

        <main class="flex-1 pb-6 md:pb-12 md:pt-6">
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
