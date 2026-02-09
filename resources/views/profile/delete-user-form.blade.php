<div class="relative bg-gray-800 rounded-3xl shadow-2xl overflow-hidden font-sans border border-red-900/30 mt-10 mb-20">
    <div class="p-8 md:p-10">
        <div class="mb-4">
            <h2 class="text-2xl font-extrabold text-red-500 tracking-tight">Zone Danger</h2>
            <p class="mt-2 text-sm text-gray-400">Supprimer définitivement votre compte.</p>
        </div>

        <div class="max-w-xl text-sm text-gray-500 mb-6">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez télécharger toutes les données que vous souhaitez conserver avant de procéder.') }}
        </div>

        <div class="mt-5">
            <button wire:click="confirmUserDeletion" class="py-3 px-6 rounded-xl font-bold text-white bg-red-600 hover:bg-red-500 shadow-lg shadow-red-900/50 transition-all">
                {{ __('Supprimer le compte') }}
            </button>
        </div>

        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">{{ __('Supprimer le compte') }}</x-slot>
            <x-slot name="content">
                {{ __('Êtes-vous sûr ? Cette action est irréversible.') }}
                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <input type="password" class="block w-3/4 rounded-xl border-gray-300 shadow-sm"
                           placeholder="{{ __('Mot de passe') }}"
                           x-ref="password"
                           wire:model="password"
                           wire:keydown.enter="deleteUser" />
                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')">{{ __('Annuler') }}</x-secondary-button>
                <x-danger-button class="ms-3" wire:click="deleteUser">{{ __('Supprimer') }}</x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>