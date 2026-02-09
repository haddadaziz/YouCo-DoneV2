<x-app-layout>
    <div class="relative py-12 md:py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto flex flex-col items-center text-center">
        
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white mb-6 tracking-tight leading-none">
            Votre table, <br />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">maintenant</span>
        </h1>
        
        <p class="max-w-2xl text-lg md:text-xl text-gray-400 mb-10 font-light leading-relaxed">
            Réservez dans les meilleurs restaurants de votre ville en quelques clics seulement.
        </p>

        <form method="GET" action="{{ route('restaurants.index') }}" class="w-full max-w-2xl relative group z-10">
            <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative flex items-center bg-[#0B1120] rounded-xl border border-white/10 p-2 shadow-2xl">
                <svg class="w-6 h-6 text-gray-500 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une ville, un type de cuisine, un nom..." class="w-full bg-transparent border-none text-white placeholder-gray-500 focus:ring-0 h-12 px-4 font-sans text-lg">
                <button type="submit" class="hidden md:block px-8 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-lg transition shadow-[0_0_20px_rgba(79,70,229,0.4)]">
                    Rechercher
                </button>
            </div>
        </form>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">

        <div class="flex items-center justify-between mb-8 border-b border-white/10 pb-4">
            <h2 class="text-2xl font-bold text-white tracking-wide">RESTAURANTS DISPONIBLES</h2>
            <div class="flex items-center gap-4">
                <div class="text-xs text-indigo-400 font-mono">Total: {{ $restaurants->count() }}</div>
                
                @auth
                    @if(auth()->user()->role === 'restaurateur')
                        <a href="{{ route('restaurants.create') }}" class="hidden sm:inline-flex items-center ml-4 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-xl shadow transition-all duration-200">
                            + Ajouter
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($restaurants as $restaurant)
                <div class="group relative bg-[#0B1120] border border-white/5 rounded-2xl overflow-hidden hover:border-indigo-500/50 transition-all duration-300 hover:shadow-[0_0_30px_rgba(79,70,229,0.15)] hover:-translate-y-1">
                    
                    <div class="h-60 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1120] via-transparent to-transparent z-10"></div>
                        <img src="{{ $restaurant->image ? asset('storage/' . $restaurant->image) : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80' }}" 
                             alt="{{ $restaurant->name }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 opacity-80 group-hover:opacity-100">
                        
                        <div class="absolute top-4 right-4 z-20">
                            <span class="px-3 py-1 rounded bg-black/60 backdrop-blur-md border border-white/10 text-xs font-bold text-white uppercase tracking-wider">
                                {{ $restaurant->cuisine_type }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 relative z-20 -mt-10">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold text-white mb-1 group-hover:text-indigo-400 transition">{{ $restaurant->name }}</h3>
                                <p class="text-sm text-gray-400 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $restaurant->city }}
                                </p>
                            </div>
                        </div>

                        <p class="text-gray-500 text-sm mt-4 line-clamp-2 leading-relaxed">
                            {{ $restaurant->description }}
                        </p>

                        <div class="mt-6 pt-6 border-t border-white/5 flex items-center justify-between">
                            <a href="{{ route('restaurants.show', $restaurant) }}" class="w-full text-center py-2 rounded-lg bg-white/5 hover:bg-indigo-600 hover:text-white text-gray-300 text-sm font-bold transition-all duration-200 flex items-center justify-center gap-2 group-hover:bg-indigo-600 group-hover:text-white">
                                RÉSERVER <span class="text-lg">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center border border-dashed border-gray-800 rounded-2xl bg-white/5">
                    <svg class="mx-auto h-12 w-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-gray-400 text-lg">Aucun restaurant trouvé pour cette recherche.</p>
                    <a href="{{ route('restaurants.index') }}" class="mt-4 inline-block text-indigo-400 hover:text-indigo-300 font-bold">Tout voir</a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>