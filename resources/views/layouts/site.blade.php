<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', "Youco'Done") }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('restaurants.index') }}" class="text-2xl font-bold text-indigo-600">
                        🍽️ Youco'Done
                    </a>
                </div>

                <div class="flex items-center space-x-4">                    
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('user/profile.show') }}" class="text-sm text-gray-700 underline">Mon Espace</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 font-medium">Se connecter</a>
                            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm font-medium transition">
                                S'inscrire
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main>
        @if (session('success') || session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="bg-gray-900 text-white py-10 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">Youco'Done</h3>
                <p class="text-gray-400 text-sm">La meilleure plateforme pour réserver vos tables en quelques clics.</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Liens utiles</h3>
                <ul class="text-gray-400 text-sm space-y-2">
                    <li><a href="#" class="hover:text-white">A propos</a></li>
                    <li><a href="#" class="hover:text-white">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Restaurateurs</h3>
                <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm">Inscrivez votre restaurant</a>
            </div>
        </div>
        <div class="text-center text-gray-500 text-xs mt-8">
            &copy; 2026 Youco'Done.
        </div>
    </footer>
</body>
</html>