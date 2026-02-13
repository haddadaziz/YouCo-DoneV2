<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center text-gray-400 hover:text-indigo-400 transition font-bold">
                    ← Retour aux restaurants
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <div class="lg:col-span-2 space-y-8">
                    <div class="h-96 rounded-3xl overflow-hidden shadow-2xl relative border border-gray-700 bg-gray-800">
                        <img src="{{ $restaurant->image ? asset('storage/' . $restaurant->image) : 'https://via.placeholder.com/800x600' }}" 
                             class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4 bg-black/60 backdrop-blur-md px-4 py-2 rounded-xl border border-white/10 font-bold uppercase tracking-wide text-sm">
                            {{ $restaurant->cuisine_type }}
                        </div>
                    </div>

                    <div>
                        <h1 class="text-4xl md:text-5xl font-black mb-4">{{ $restaurant->name }}</h1>
                        
                        <div class="flex items-center text-gray-300 mb-8 text-lg">
                            <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $restaurant->address }}, {{ $restaurant->zip_code }} {{ $restaurant->city }}
                        </div>

                        <div class="bg-gray-800 p-8 rounded-3xl border border-gray-700 shadow-lg">
                            <h3 class="text-xl font-bold mb-4 text-indigo-400 uppercase tracking-widest text-xs">À propos</h3>
                            <p class="text-gray-300 leading-relaxed text-lg">{{ $restaurant->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-gray-800 rounded-3xl p-8 border border-gray-700 sticky top-24 shadow-2xl">
                        <h3 class="text-2xl font-bold mb-6">Réserver une table</h3>
                        
                        <form action="{{ route('reservations.store', $restaurant) }}" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <label class="block text-sm font-bold text-gray-400 mb-2">Date</label>
                                <input type="date" name="date" class="w-full bg-gray-900 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-400 mb-2">Heure</label>
                                <input type="time" name="time" class="w-full bg-gray-900 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-400 mb-2">Personnes</label>
                                <input type="number" name="number_of_guests" min="1" class="w-full bg-gray-900 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-400 mb-2">Notes (Allergies, etc.)</label>
                                <textarea name="notes" class="w-full bg-gray-900 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:-translate-y-1 mt-4">
                                Réserver (Acompte 10€)
                            </button>
                            <p class="text-xs text-center text-gray-500 mt-2">Paiement sécurisé via Stripe.</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>