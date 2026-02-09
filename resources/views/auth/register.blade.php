<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription - Youco'Done</title>
    
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
                        Créer un compte
                    </h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Rejoignez la communauté et réservez instantanément.
                    </p>
                </div>

                <div class="mt-8">
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                            <div class="flex">
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Erreur d'inscription</h3>
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

                    <form action="{{ route('register') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700">Nom complet</label>
                            <div class="mt-2">
                                <input id="name" name="name" type="text" autocomplete="name" required autofocus
                                    class="block w-full rounded-xl border-0 py-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-gray-50 focus:bg-white transition-all"
                                    placeholder="ex: Jean Dupont"
                                    value="{{ old('name') }}">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700">Adresse Email</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required 
                                    class="block w-full rounded-xl border-0 py-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-gray-50 focus:bg-white transition-all"
                                    placeholder="ex: jean@exemple.com"
                                    value="{{ old('email') }}">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-bold text-gray-700">Mot de passe</label>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="new-password" required 
                                    class="block w-full rounded-xl border-0 py-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-gray-50 focus:bg-white transition-all"
                                    placeholder="Au moins 8 caractères">
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-gray-700">Confirmer le mot de passe</label>
                            <div class="mt-2">
                                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                                    class="block w-full rounded-xl border-0 py-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-gray-50 focus:bg-white transition-all"
                                    placeholder="Répétez le mot de passe">
                            </div>
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-bold text-gray-700">Je m'inscris en tant que</label>
                            <div class="mt-2">
                                <select id="role" name="role" required class="block w-full rounded-xl border-0 py-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-200 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm bg-gray-50 focus:bg-white transition-all">
                                    <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                                    <option value="restaurateur" {{ old('role') == 'restaurateur' ? 'selected' : '' }}>Restaurateur</option>
                                </select>
                            </div>
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="flex items-start">
                                <div class="flex h-6 items-center">
                                    <input id="terms" name="terms" type="checkbox" required 
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="ml-3 text-sm leading-6">
                                    <label for="terms" class="font-medium text-gray-700">
                                        J'accepte les <a target="_blank" href="{{ route('terms.show') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Conditions d'utilisation</a>
                                        et la <a target="_blank" href="{{ route('policy.show') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Politique de confidentialité</a>.
                                    </label>
                                </div>
                            </div>
                        @endif

                        <div>
                            <button type="submit" 
                                class="flex w-full justify-center rounded-xl bg-indigo-600 px-3 py-4 text-sm font-bold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all transform hover:-translate-y-0.5">
                                S'inscrire
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-500">
                            Déjà inscrit ?
                            <a href="{{ route('login') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                                Se connecter à mon compte
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover" 
                 src="https://images.unsplash.com/photo-1544148103-0773bf10d330?q=80&w=1974&auto=format&fit=crop" 
                 alt="Friends dining together">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            
            <div class="absolute bottom-0 left-0 p-16 text-white max-w-2xl">
                <blockquote class="mt-6 text-2xl font-semibold italic leading-8 text-white">
                    "Plus qu'une réservation, une expérience. Rejoignez des milliers de passionnés de gastronomie."
                </blockquote>
                <div class="mt-4 flex items-center gap-x-4">
                    <div class="text-sm leading-6 font-bold uppercase tracking-widest text-indigo-400">Youco'Done</div>
                    <svg viewBox="0 0 2 2" width="2" height="2" aria-hidden="true" class="fill-white"><circle cx="1" cy="1" r="1" /></svg>
                    <div class="text-sm leading-6 text-gray-300">Rejoindre la communauté</div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>