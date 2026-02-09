<div class="relative bg-gray-800 rounded-3xl shadow-2xl overflow-hidden font-sans border border-gray-700">
    <!-- Header personnalisé -->
    <div class="bg-gradient-to-r from-indigo-700 via-purple-700 to-indigo-900 px-8 py-6 rounded-t-3xl flex flex-col sm:flex-row items-center justify-between shadow-xl border-b border-indigo-900">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Mon Profil</h1>
            <p class="mt-1 text-sm text-indigo-200">Gérez vos informations personnelles et votre identité visuelle.</p>
        </div>

    </div>
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600"></div>

    <form wire:submit.prevent="updateProfileInformation" class="p-8 md:p-10">
        
        <div class="mb-10 text-center sm:text-left">
            <h2 class="text-2xl font-extrabold text-white tracking-tight">
                Identité Visuelle
            </h2>
            <p class="mt-2 text-sm text-gray-400">
                Vos informations publiques sur la plateforme.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="lg:col-span-4 flex flex-col items-center">
                    <input type="file" id="photo" class="hidden"
                                wire:model.live="photo"
                                x-ref="photo"
                                x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                " />

                    <div class="relative group cursor-pointer" x-on:click.prevent="$refs.photo.click()">
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" 
                                 class="size-40 rounded-3xl object-cover shadow-2xl ring-4 ring-gray-700 group-hover:ring-indigo-500 transition-all duration-300">
                        </div>

                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block size-40 rounded-3xl bg-cover bg-no-repeat bg-center shadow-2xl ring-4 ring-gray-700 group-hover:ring-indigo-500 transition-all duration-300"
                                  x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-3 w-full max-w-[200px]">
                        <button type="button" x-on:click.prevent="$refs.photo.click()"
                            class="w-full py-2.5 px-4 bg-gray-700 text-white font-bold rounded-xl text-sm hover:bg-gray-600 transition-colors border border-gray-600">
                            Changer
                        </button>
                        @if ($this->user->profile_photo_path)
                            <button type="button" wire:click="deleteProfilePhoto"
                                class="text-xs text-red-400 hover:text-red-300 font-semibold tracking-wide uppercase transition-colors text-center">
                                Supprimer
                            </button>
                        @endif
                    </div>
                    <x-input-error for="photo" class="mt-2" />
                </div>
            @endif

            <div class="lg:col-span-8 flex flex-col justify-center space-y-8">
                <div class="group">
                    <label for="name" class="block text-sm font-bold text-gray-400 mb-2 group-focus-within:text-indigo-400 transition-colors">Nom complet</label>
                    <input id="name" type="text" wire:model="state.name" required autocomplete="name"
                        class="block w-full rounded-2xl border-0 py-4 px-5 text-white shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-600 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-base bg-gray-900 focus:bg-gray-800 transition-all duration-200" />
                    <x-input-error for="name" class="mt-2" />
                </div>

                <div class="group">
                    <label for="email" class="block text-sm font-bold text-gray-400 mb-2 group-focus-within:text-indigo-400 transition-colors">Adresse Email</label>
                    <input id="email" type="email" wire:model="state.email" required autocomplete="username"
                        class="block w-full rounded-2xl border-0 py-4 px-5 text-white shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-600 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-base bg-gray-900 focus:bg-gray-800 transition-all duration-200" />
                    <x-input-error for="email" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="mt-12 pt-6 border-t border-gray-700 flex items-center justify-end">
            <x-action-message class="me-4" on="saved">
                <span class="text-green-400 font-bold text-sm">Sauvegardé</span>
            </x-action-message>

            <button wire:loading.attr="disabled" wire:target="photo" type="submit"
                class="inline-flex justify-center items-center py-3 px-6 border border-transparent rounded-xl text-base font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow-lg shadow-indigo-900/50 transition-all duration-200 hover:-translate-y-1">
                {{ __('Enregistrer') }}
            </button>
        </div>
    </form>
</div>