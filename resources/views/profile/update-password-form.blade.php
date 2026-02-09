<div class="relative bg-gray-800 rounded-3xl shadow-2xl overflow-hidden font-sans border border-gray-700 mt-10">
    
    <div class="p-8 md:p-10">
        <div class="mb-8">
            <h2 class="text-2xl font-extrabold text-white tracking-tight">Sécurité</h2>
            <p class="mt-2 text-sm text-gray-400">Mettez à jour votre mot de passe pour sécuriser votre compte.</p>
        </div>

        <form wire:submit.prevent="updatePassword" class="space-y-6 max-w-2xl">
            
            <div class="group">
                <label for="current_password" class="block text-sm font-bold text-gray-400 mb-2">Mot de passe actuel</label>
                <input id="current_password" type="password" wire:model="state.current_password" autocomplete="current-password"
                    class="block w-full rounded-2xl border-0 py-4 px-5 text-white shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-600 focus:ring-2 focus:ring-inset focus:ring-indigo-500 bg-gray-900 focus:bg-gray-800 transition-all" />
                <x-input-error for="current_password" class="mt-2" />
            </div>

            <div class="group">
                <label for="password" class="block text-sm font-bold text-gray-400 mb-2">Nouveau mot de passe</label>
                <input id="password" type="password" wire:model="state.password" autocomplete="new-password"
                    class="block w-full rounded-2xl border-0 py-4 px-5 text-white shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-600 focus:ring-2 focus:ring-inset focus:ring-indigo-500 bg-gray-900 focus:bg-gray-800 transition-all" />
                <x-input-error for="password" class="mt-2" />
            </div>

            <div class="group">
                <label for="password_confirmation" class="block text-sm font-bold text-gray-400 mb-2">Confirmer le mot de passe</label>
                <input id="password_confirmation" type="password" wire:model="state.password_confirmation" autocomplete="new-password"
                    class="block w-full rounded-2xl border-0 py-4 px-5 text-white shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-600 focus:ring-2 focus:ring-inset focus:ring-indigo-500 bg-gray-900 focus:bg-gray-800 transition-all" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>

            <div class="pt-4 flex items-center justify-end">
                <x-action-message class="me-4" on="saved">
                    <span class="text-green-400 font-bold text-sm">Modifié</span>
                </x-action-message>

                <button type="submit" class="py-3 px-6 rounded-xl text-base font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow-lg shadow-indigo-900/50 transition-all duration-200 hover:-translate-y-1">
                    {{ __('Sauvegarder') }}
                </button>
            </div>
        </form>
    </div>
</div>