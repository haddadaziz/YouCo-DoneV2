<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=orbitron:400,500,700,900|outfit:300,400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Outfit', sans-serif; }
            h1, h2, h3, .brand-font { font-family: 'Orbitron', sans-serif; }
        </style>
    </head>
    <body class="bg-[#030712] text-gray-100 antialiased overflow-x-hidden">
        
        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/20 blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-purple-600/20 blur-[120px]"></div>
        </div>

        <div class="relative z-10 font-sans text-gray-900 antialiased min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-[0_0_20px_rgba(99,102,241,0.5)] group-hover:shadow-[0_0_40px_rgba(99,102,241,0.8)] transition-all duration-500">
                        <span class="text-white font-bold text-2xl brand-font">Y</span>
                    </div>
                    <span class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 brand-font tracking-wider">
                        YOUCO'DONE
                    </span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-gray-900/60 backdrop-blur-xl border border-white/10 shadow-2xl overflow-hidden sm:rounded-2xl ring-1 ring-white/5 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-indigo-500 to-transparent opacity-70"></div>
                
                {{ $slot }}
            </div>
        </div>
    </body>
</html>