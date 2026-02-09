<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - Youco'Done</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900">

    <div class="flex min-h-full">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white z-10 relative">
            
            <div class="absolute top-8 left-8">
                <a href="/" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition flex items-center gap-2">
                    &larr; Retour au site
                </a>
            </div>

            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-8 text-3xl font-extrabold tracking-tight text-gray-900">
                        Content de vous revoir
                    </h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Connectez-vous pour gérer vos réservations.
                    </p>
                </div>

                <div class="mt-10">
                    @if ($errors->any())
                        <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                            <div class="flex">
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Attention</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @session('status')
                        <div class="mb-4 text-sm font-medium text-green-600 p-3 bg-green-50 rounded-md">
                            {{ $value }}
                        </div>
                    @endsession

                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700">Adresse Email</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required 
                                    class="block w-full rounded-xl border-0 py-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-gray-50 focus:bg-white transition-all"
                                    placeholder="ex: jean.dupont@exemple.com"
                                    value="{{ old('email') }}">
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-bold text-gray-700">Mot de passe</label>
                                @if (Route::has('password.request'))
                                    <div class="text-sm">
                                        <a href="{{ route('password.request') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
                                            Oublié ?
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="current-password" required 
                                    class="block w-full rounded-xl border-0 py-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-gray-50 focus:bg-white transition-all"
                                    placeholder="••••••••">
                            </div>
                        </div>

                        <div class="flex items-center">
                            <input id="remember-me" name="remember" type="checkbox" 
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-700">
                                Se souvenir de moi
                            </label>
                        </div>

                        <div>
                            <button type="submit" 
                                class="flex w-full justify-center rounded-xl bg-indigo-600 px-3 py-4 text-sm font-bold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all transform hover:-translate-y-0.5">
                                Se connecter
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-500">
                            Pas encore membre ?
                            <a href="{{ route('register') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                                Créer un compte gratuitement
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover" 
                 src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1974&auto=format&fit=crop" 
                 alt="Dining Experience">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            
            <div class="absolute bottom-0 left-0 p-16 text-white max-w-2xl">
                <blockquote class="mt-6 text-2xl font-semibold italic leading-8 text-white">
                    "La meilleure façon de découvrir une ville, c'est de s'asseoir à ses meilleures tables."
                </blockquote>
                <div class="mt-4 flex items-center gap-x-4">
                    <div class="text-sm leading-6 font-bold uppercase tracking-widest text-indigo-400">Youco'Done</div>
                    <svg viewBox="0 0 2 2" width="2" height="2" aria-hidden="true" class="fill-white"><circle cx="1" cy="1" r="1" /></svg>
                    <div class="text-sm leading-6 text-gray-300">Future of Dining</div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>