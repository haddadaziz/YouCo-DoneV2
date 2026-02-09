<div class="relative bg-gray-800 rounded-3xl shadow-2xl overflow-hidden font-sans border border-gray-700 mt-10">
    <div class="p-8 md:p-10">
        <div class="mb-6">
            <h2 class="text-2xl font-extrabold text-white tracking-tight">Sessions Actives</h2>
            <p class="mt-2 text-sm text-gray-400">Gérez vos connexions sur d'autres appareils.</p>
        </div>

        <div class="max-w-xl text-sm text-gray-400 mb-6">
            {{ __('Si nécessaire, vous pouvez vous déconnecter de toutes vos autres sessions de navigation sur tous vos appareils.') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="space-y-4">
                @foreach ($this->sessions as $session)
                    <div class="flex items-center p-4 bg-gray-900 rounded-xl border border-gray-700">
                        <div class="text-gray-500">
                            @if ($session->agent->isDesktop())
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            @endif
                        </div>

                        <div class="ms-4">
                            <div class="text-sm font-bold text-white">
                                {{ $session->agent->platform() ? $session->agent->platform() : __('Inconnu') }} - {{ $session->agent->browser() ? $session->agent->browser() : __('Inconnu') }}
                            </div>

                            <div class="text-xs text-gray-500 mt-1">
                                {{ $session->ip_address }},
                                @if ($session->is_current_device)
                                    <span class="text-green-400 font-semibold">{{ __('Cet appareil') }}</span>
                                @else
                                    {{ __('Dernière activité') }} {{ $session->last_active }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-8">
            <button wire:click="confirmLogout" class="py-3 px-6 rounded-xl font-bold text-white bg-gray-700 hover:bg-gray-600 border border-gray-600 shadow-lg transition-all">
                {{ __('Déconnecter les autres sessions') }}
            </button>

            <x-action-message class="ms-3" on="loggedOut">
                <span class="text-green-400 font-bold">Fait.</span>
            </x-action-message>
        </div>

        <x-dialog-modal wire:model.live="confirmingLogout">
            <x-slot name="title">{{ __('Déconnecter les autres sessions') }}</x-slot>
            <x-slot name="content">
                {{ __('Veuillez entrer votre mot de passe pour confirmer.') }}
                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <input type="password" class="block w-3/4 rounded-xl border-gray-300 shadow-sm"
                           placeholder="{{ __('Mot de passe') }}"
                           x-ref="password"
                           wire:model="password"
                           wire:keydown.enter="logoutOtherBrowserSessions" />
                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingLogout')">{{ __('Annuler') }}</x-secondary-button>
                <x-button class="ms-3" wire:click="logoutOtherBrowserSessions">{{ __('Déconnecter') }}</x-button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>