<div class="">
    <!--<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">-->
        <!--<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            auth
                x-jet-welcome />
            else
            endauth-->

        <x-jet-action-section>
            <x-slot name="title">
                {{ __('Aggiungi macchine') }}
            </x-slot>

            <x-slot name="description">
                {{ __('') }}
            </x-slot>

            <x-slot name="content">
                @if(count($machines)>0)
                @else
                    <h3 class="text-lg font-medium text-gray-900">
                        Al momento non hai macchinari
                    </h3>
                @endif

                <div class="mt-3 max-w-xl text-sm text-gray-600">
                    <p>
                        @if(count($machines)>0)
                            {{ __('Aggiungi altre macchine, ne potrai aggiungere fino a 10.') }}
                        @else
                            {{ __('Aggiungine uno per poter utilizzare le nostre funzionalità.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4">
                    <x-jet-button wire:click="addMachine()">
                        {{ __('Aggiungi') }}
                    </x-jet-button>
                </div>

            </x-slot>

        </x-jet-action-section>
    <!--</div>-->
    <x-jet-dialog-modal wire:model="modalMachine" >
        <x-slot name="title">
            {{ __('Aggiungi macchina') }}
        </x-slot>

        <x-slot name="content">
            <!--<div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                <h3>CIAO</h3>
            </div>-->
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                       wire:model="photo"
                       x-ref="photo"
                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Foto') }}" />



                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Seleziona') }}
                </x-jet-secondary-button>


                <x-jet-input-error for="photo" class="mt-2" />
            </div>
                <!-- Name -->
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" autocomplete="off" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="date" value="{{ __('Ultima revisione') }}" />
                <x-jet-input id="date" type="date" class="mt-1 w-full" />
                <x-jet-input-error for="date" class="mt-2" />
            </div>


        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="stopManagingRole" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="updateRole" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


</div>
