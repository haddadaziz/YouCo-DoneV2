<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', "Youco'Done") }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=orbitron:400,500,600,700,900|outfit:300,400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #030712; }
        .font-tech { font-family: 'Orbitron', sans-serif; }
        .glass-nav { background: rgba(3, 7, 18, 0.7); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.05); }
    </style>
</head>
<body class="text-slate-300 antialiased overflow-x-hidden selection:bg-indigo-500 selection:text-white">

    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-600/10 rounded-full blur-[128px]"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-600/10 rounded-full blur-[128px]"></div>
    </div>

    <nav x-data="{ open: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)"
         :class="{'glass-nav': scrolled, 'bg-transparent': !scrolled}"
         class="fixed w-full z-50 transition-all duration-300 border-b border-transparent">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-24 items-center">
                <div class="flex items-center">
                    <a href="{{ route('restaurants.index') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/50 group-hover:scale-110 transition duration-300">
                            <span class="font-tech text-white font-bold text-xl">Y</span>
                        </div>
                        <span class="text-2xl font-tech font-bold text-white tracking-widest group-hover:text-indigo-400 transition">YOUCO'DONE</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">                    
                    @if (Route::has('login'))
                        @auth
                            @if(auth()->user()->role === 'restaurateur')
                                <a href="{{ route('dashboard.restaurateur') }}" class="px-6 py-2 rounded-lg bg-indigo-600 border border-indigo-700 hover:bg-indigo-700 text-white font-bold transition backdrop-blur-md">Dashboard Restaurateur</a>
                            @endif
                            <a href="{{ url('/user/profile') }}" class="px-6 py-2 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 text-white transition backdrop-blur-md">Mon Espace</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="ml-4 px-4 py-2 rounded-lg bg-red-600/80 border border-red-700 text-white font-bold text-xs hover:bg-red-700 transition backdrop-blur-md">Déconnexion</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-400 hover:text-white transition">Connexion</a>
                            <a href="{{ route('register') }}" class="relative group px-6 py-2.5">
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg blur opacity-60 group-hover:opacity-100 transition duration-300"></div>
                                <div class="relative bg-black bg-opacity-90 border border-white/10 rounded-lg px-6 py-2.5 text-white font-bold text-sm tracking-wide group-hover:bg-opacity-0 transition duration-300">
                                    S'INSCRIRE
                                </div>
                            </a>
                        @endauth
                    @endif
                </div>

                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="open = !open" class="text-gray-300 hover:text-white p-2">
                        <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-5"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="md:hidden bg-[#030712]/95 backdrop-blur-xl border-b border-white/10 absolute w-full">
            <div class="px-4 pt-2 pb-6 space-y-4">
                <a href="{{ route('restaurants.index') }}" class="block text-base font-medium text-white hover:text-indigo-400">EXPLORER</a>
                <div class="border-t border-white/10 pt-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block text-center w-full bg-indigo-600 text-white py-3 rounded-lg font-bold">MON ESPACE</a>
                    @else
                        <a href="{{ route('login') }}" class="block text-center w-full bg-white/5 text-white py-3 rounded-lg mb-3">CONNEXION</a>
                        <a href="{{ route('register') }}" class="block text-center w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-lg font-bold">INSCRIPTION</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="relative z-10 pt-24 min-h-screen">
        {{ $slot }}
    </main>

    <footer class="border-t border-white/5 bg-black/40 backdrop-blur-sm mt-20 py-12 relative z-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-500 text-sm font-tech">YOUCO'DONE SYSTEMS © 2024</p>
        </div>
    </footer>
</body>
</html>