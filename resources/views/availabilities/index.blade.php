<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Gérer les disponibilités de ') }} {{ $restaurant->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 border border-gray-700">
                
                <form action="{{ route('restaurants.availabilities.store', $restaurant) }}" method="POST" class="mb-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <x-label for="date" value="Date" class="text-gray-300" />
                            <x-input id="date" type="date" name="date" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" required />
                        </div>
                        <div>
                            <x-label for="start_time" value="Heure de début" class="text-gray-300" />
                            <x-input id="start_time" type="time" name="start_time" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" required />
                        </div>
                        <div>
                            <x-label for="end_time" value="Heure de fin" class="text-gray-300" />
                            <x-input id="end_time" type="time" name="end_time" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" required />
                        </div>
                        <div>
                            <x-label for="capacity" value="Capacité (couverts)" class="text-gray-300" />
                            <x-input id="capacity" type="number" name="capacity" class="block mt-1 w-full bg-gray-700 text-white border-gray-600" required />
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-button class="bg-indigo-600 hover:bg-indigo-700">Ajouter une disponibilité</x-button>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Créneau</th>
                                <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Capacité</th>
                                <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @foreach($availabilities as $availability)
                            <tr class="hover:bg-gray-750 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $availability->date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $availability->start_time }} - {{ $availability->end_time }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $availability->capacity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('availabilities.destroy', $availability) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 font-medium">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($availabilities->isEmpty())
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Aucune disponibilité définie.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
