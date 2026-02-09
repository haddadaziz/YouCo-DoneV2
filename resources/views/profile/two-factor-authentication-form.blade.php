<div class="relative bg-gray-800 rounded-3xl shadow-2xl overflow-hidden font-sans border border-gray-700 mt-10">
    
    <div class="p-8 md:p-10">
        <div class="mb-6">
            <h2 class="text-2xl font-extrabold text-white tracking-tight">Authentification à deux facteurs</h2>
            <p class="mt-2 text-sm text-gray-400">Ajoutez une couche de sécurité supplémentaire.</p>
        </div>

        <div class="bg-gray-900 rounded-2xl p-6 border border-gray-700">
            <h3 class="text-lg font-bold text-white">
                @if ($this->enabled)
                    @if ($showingConfirmation)
                        {{ __('Terminer l\'activation.') }}
                    @else
                        <span class="text-green-400">{{ __('L\'authentification à deux facteurs est activée.') }}</span>
                    @endif
                @else
                    {{ __('L\'authentification à deux facteurs n\'est pas activée.') }}
                @endif
            </h3>

            <p class="mt-3 text-sm text-gray-400 leading-relaxed">
                {{ __('Une fois activé, un jeton sécurisé et aléatoire vous sera demandé lors de l\'authentification. Vous pouvez récupérer ce jeton depuis l\'application Google Authenticator de votre téléphone.') }}
            </p>

            @if ($this->enabled)
                @if ($showingQrCode)
                    <div class="mt-6">
                        <p class="font-semibold text-white mb-4">
                            @if ($showingConfirmation)
                                {{ __('Pour terminer, scannez ce code QR avec votre application d\'authentification.') }}
                            @else
                                {{ __('Le 2FA est activé. Scannez ce code QR avec votre application d\'authentification.') }}
                            @endif
                        </p>
                        <div class="p-4 bg-white inline-block rounded-xl">
                            {!! $this->user->twoFactorQrCodeSvg() !!}
                        </div>
                        <div class="mt-4 text-sm text-gray-400">
                            <p class="font-semibold">Clé de configuration : <span class="text-white font-mono bg-gray-700 px-2 py-1 rounded">{{ decrypt($this->user->two_factor_secret) }}</span></p>
                        </div>
                    </div>
                @endif

                @if ($showingRecoveryCodes)
                    <div class="mt-6">
                        <p class="font-semibold text-white mb-4">
                            {{ __('Conservez ces codes de récupération dans un endroit sûr.') }}
                        </p>
                        <div class="grid gap-1 max-w-xl p-4 bg-gray-900 rounded-xl border border-gray-700 font-mono text-sm text-gray-300">
                            @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                                <div>{{ $code }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif

            <div class="mt-6 flex items-center gap-3">
                @if (! $this->enabled)
                    <x-confirms-password wire:then="enableTwoFactorAuthentication">
                        <button type="button" class="py-3 px-6 rounded-xl font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow-lg shadow-indigo-900/50 transition-all">
                            {{ __('Activer') }}
                        </button>
                    </x-confirms-password>
                @else
                    @if ($showingRecoveryCodes)
                        <x-confirms-password wire:then="regenerateRecoveryCodes">
                            <button type="button" class="py-2 px-4 rounded-lg bg-gray-700 text-white hover:bg-gray-600 border border-gray-600 font-medium text-sm">
                                {{ __('Régénérer les codes') }}
                            </button>
                        </x-confirms-password>
                    @elseif ($showingConfirmation)
                        <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                            <button type="button" class="py-3 px-6 rounded-xl font-bold text-white bg-indigo-600 hover:bg-indigo-500 transition-all">
                                {{ __('Confirmer') }}
                            </button>
                        </x-confirms-password>
                    @else
                        <x-confirms-password wire:then="showRecoveryCodes">
                            <button type="button" class="py-2 px-4 rounded-lg bg-gray-700 text-white hover:bg-gray-600 border border-gray-600 font-medium text-sm">
                                {{ __('Voir les codes') }}
                            </button>
                        </x-confirms-password>
                    @endif

                    @if ($showingConfirmation)
                        <x-confirms-password wire:then="disableTwoFactorAuthentication">
                            <button type="button" class="py-2 px-4 rounded-lg text-gray-400 hover:text-white transition-colors">
                                {{ __('Annuler') }}
                            </button>
                        </x-confirms-password>
                    @else
                        <x-confirms-password wire:then="disableTwoFactorAuthentication">
                            <button type="button" class="py-2 px-4 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500/20 border border-red-500/20 font-medium text-sm">
                                {{ __('Désactiver') }}
                            </button>
                        </x-confirms-password>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>