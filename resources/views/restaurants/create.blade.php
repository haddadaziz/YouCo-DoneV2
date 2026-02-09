<x-app-layout>
    @if ($errors->any())
    <div class="max-w-4xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-red-500 text-white p-4 rounded-xl shadow-lg border border-red-700">
            <div class="flex items-center mb-2">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-bold text-lg">Il y a un problème avec le formulaire :</span>
            </div>
            <ul class="list-disc list-inside ml-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="py-12 bg-gray-900 min-h-screen">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-8 flex justify-end">
            <a href="{{ route('dashboard.restaurateur') }}" class="inline-flex items-center px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl shadow transition-all duration-200">
                ← Revenir au tableau de bord
            </a>
        </div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="relative bg-gray-800 rounded-3xl shadow-2xl overflow-hidden font-sans border border-gray-700">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600"></div>

                <div class="p-8 md:p-10">
                    <div class="mb-8">
                        <h1 class="text-2xl font-extrabold text-white tracking-tight">Nouveau Restaurant</h1>
                        <p class="mt-2 text-sm text-gray-400">Remplissez les informations pour référencer votre établissement.</p>
                    </div>

                    <form action="{{ route('restaurants.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="group">
                            <label for="name" class="block text-sm font-bold text-gray-400 mb-2">Nom de l'établissement</label>
                            <input type="text" name="name" id="name" required placeholder="Ex: Le Gourmet Futuriste" value="{{ old('name') }}"
                                class="block w-full rounded-2xl border-0 py-4 px-5 text-white shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-600 focus:ring-2 focus:ring-inset focus:ring-indigo-500 bg-gray-900 focus:bg-gray-800 transition-all duration-200">
                            @error('name') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label for="description" class="block text-sm font-bold text-gray-400 mb-2">Description</label>
                            <textarea name="description" id="description" rows="4" required placeholder="Description..."
                                class="block w-full rounded-2xl border-0 py-4 px-5 text-white shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-600 focus:ring-2 focus:ring-inset focus:ring-indigo-500 bg-gray-900 focus:bg-gray-800 transition-all duration-200">{{ old('description') }}</textarea>
                            @error('description') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="city" class="block text-sm font-bold text-gray-400 mb-2">Ville</label>
                                <input type="text" name="city" id="city" required placeholder="Ex: Paris" value="{{ old('city') }}"
                                    class="block w-full rounded-2xl border-0 py-4 px-5 text-white shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-600 focus:ring-2 focus:ring-inset focus:ring-indigo-500 bg-gray-900 focus:bg-gray-800 transition-all duration-200">
                            </div>
                        </div>

                        <div class="group">
                            <label for="capacity" class="block text-sm font-bold text-gray-400 mb-2">Capacité (Nombre de places)</label>
                            <input type="number" name="capacity" id="capacity" required min="1" placeholder="Ex: 50" value="{{ old('capacity') }}"
                                class="block w-full rounded-2xl border-0 py-4 px-5 text-white shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-600 focus:ring-2 focus:ring-inset focus:ring-indigo-500 bg-gray-900 focus:bg-gray-800 transition-all duration-200">
                            @error('capacity') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label for="address" class="block text-sm font-bold text-gray-400 mb-2">Adresse complète</label>
                            <input type="text" name="address" id="address" required placeholder="Adresse..." value="{{ old('address') }}"
                                class="block w-full rounded-2xl border-0 py-4 px-5 text-white shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-600 focus:ring-2 focus:ring-inset focus:ring-indigo-500 bg-gray-900 focus:bg-gray-800 transition-all duration-200">
                        </div>

                        <div>
                            <label for="cuisine_type" class="block text-sm font-bold text-gray-400 mb-2">Type de Cuisine</label>
                            <select name="cuisine_type" id="cuisine_type" required
                                class="block w-full rounded-2xl border-0 py-4 px-5 text-white shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-600 focus:ring-2 focus:ring-inset focus:ring-indigo-500 bg-gray-900 focus:bg-gray-800 transition-all duration-200">
                                <option value="" disabled selected>Choisir un type...</option>
                                <option value="Française">Française</option>
                                <option value="Italienne">Italienne</option>
                                <option value="Japonaise">Japonaise</option>
                                <option value="Fast Food">Fast Food</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2">Photo</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-700 border-dashed rounded-2xl cursor-pointer bg-gray-900 hover:bg-gray-800 transition-all group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-3 text-gray-500 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-bold text-white">Cliquez pour uploader</span></p>
                                    </div>
                                    <input id="image" name="image" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-700">
                            <a href="{{ route('dashboard.restaurateur') }}" class="px-5 py-3 text-gray-400 hover:text-white font-bold transition-colors">Annuler</a>
                            <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl shadow-lg transition-all">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>