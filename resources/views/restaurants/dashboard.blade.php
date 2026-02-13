<x-app-layout>

    <div class="py-12 bg-gray-900 min-h-screen">
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-8 flex justify-end">
            <a href="{{ route('profile.show') }}" class="inline-flex items-center px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl shadow transition-all duration-200">
                ← Revenir à mon profil
            </a>
        </div>

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="relative bg-gray-800 rounded-3xl shadow-2xl overflow-hidden font-sans border border-gray-700">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600"></div>

                <div class="p-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                        <div>
                            <h1 class="text-2xl font-extrabold text-white tracking-tight">Mes Restaurants</h1>
                            <p class="mt-1 text-sm text-gray-400">Gérez vos établissements et vos menus.</p>
                        </div>
                        
                        <a href="{{ route('restaurants.create') }}" class="inline-flex items-center px-5 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl shadow-lg shadow-indigo-900/40 transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Ajouter un restaurant
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($restaurants as $restaurant)
                            <div class="group relative bg-gray-900 rounded-2xl p-5 border border-gray-700 hover:border-indigo-500 transition-all duration-300 flex flex-col sm:flex-row justify-between items-center gap-4">
                                
                                <div class="flex items-center gap-5 w-full sm:w-auto">
                                    <div class="h-16 w-16 rounded-xl bg-gray-800 bg-cover bg-center flex-shrink-0 border border-gray-700"
                                         style="background-image: url('{{ $restaurant->image ? asset('storage/' . $restaurant->image) : 'https://via.placeholder.com/150' }}')">
                                    </div>

                                    <div>
                                        <h3 class="text-lg font-bold text-white group-hover:text-indigo-400 transition-colors">{{ $restaurant->name }}</h3>
                                        <div class="flex items-center text-sm text-gray-500 mt-1">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                {{ $restaurant->city }}
                                            </span>
                                            <span class="mx-2">•</span>
                                            <span class="bg-gray-800 text-gray-300 px-2 py-0.5 rounded text-xs border border-gray-700">
                                                {{ $restaurant->cuisine_type }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                                    <a href="{{ route('restaurants.availabilities.index', $restaurant) }}" class="px-4 py-2 text-sm font-bold text-gray-300 bg-gray-800 hover:bg-gray-700 hover:text-white rounded-lg border border-gray-700 transition-all">
                                        Disponibilités
                                    </a>
                                    <a href="{{ route('restaurants.edit', $restaurant) }}" class="px-4 py-2 text-sm font-bold text-gray-300 bg-gray-800 hover:bg-gray-700 hover:text-white rounded-lg border border-gray-700 transition-all">
                                        Modifier
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 px-4 border-2 border-dashed border-gray-700 rounded-2xl">
                                <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                <h3 class="mt-2 text-sm font-medium text-white">Aucun restaurant</h3>
                                <p class="mt-1 text-sm text-gray-500">Commencez par ajouter votre premier établissement.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>