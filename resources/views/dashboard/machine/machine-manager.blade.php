<div>
    <!--<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">-->

    <x-jet-action-section>
        <x-slot name="title">
            {{ __('Gestisci macchine') }}
        </x-slot>

        <x-slot name="description">
            @if(count($machines)>0)
                {{ __('Lista delle tue macchine') }}
            @else
                {{ __('') }}
            @endif
        </x-slot>

        <x-slot name="content">
            <h3 class="text-lg font-medium text-gray-900">
                @if(count($machines)>0)
                    {{ __('Macchine') }}
                @else
                    {{ __('Al momento non hai macchinari') }}
                @endif
            </h3>
            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    @if(count($machines)>0)
                        {{ __('Gestisci le tue macchine e le loro revisioni.') }}
                    @else
                        {{ __('Aggiungi almeno una macchina') }}
                    @endif
                </p>
            </div>

            <div class="mt-3 text-sm text-gray-600">
                <div class="col-span-6 lg:col-span-4">
                    @foreach ($machines as $machine)
                        <!--<div class="mt-1 border border-gray-200 rounded-lg cursor-pointer" style="display: flex;align-items: center">-->
                        <div class="mt-1 border border-gray-200 rounded-lg d-flex flex-wrap">
                            <div class="mr-auto m-2">
                                <!-- Role Name -->
                                <div class="flex items-center">
                                    <div class="text-sm text-gray-600 font-semibold">
                                        {{ $machine->name }}
                                    </div>
                                </div>

                                <!-- Role Description -->
                                <div class="mt-2 text-xs text-gray-600">
                                    {{ __('Ultima revisione:') }}
                                    {{ date('d/m/Y', strtotime($machine->revisione)) }}
                                </div>
                            </div>
                            <div class="m-2 d-flex justify-content-end">
                                <x-jet-secondary-button class="ml-2" wire:click='modalInfo({{ $machine->id }})' wire:loading.attr="disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                </x-jet-secondary-button>
                                <x-jet-button class="ml-2" wire:click="modalRevision({{ $machine->id }})" wire:loading.attr="disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                    </svg>
                                </x-jet-button>
                                <x-jet-danger-button class="ml-2" wire:click='modalDelete({{ $machine->id }})' wire:loading.attr="disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </x-jet-danger-button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if(count($machines)<10)
                <div class="mt-4">
                    <x-jet-button wire:click="modalAdd">
                        {{ __('Aggiungi') }}
                    </x-jet-button>
                </div>
            @endif
        </x-slot>
    </x-jet-action-section>

    <!--</div>-->

    <!-- Add machine -->
    <x-jet-dialog-modal wire:model="stateModalAdd" >
        <x-slot name="title">
            {{ __('Aggiungi macchina') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="photo" value="{{ __('Foto') }}" />
                @if($photo)
                    <img src="{{ $photo->temporaryUrl() }}" width="200" class="rounded img-thumbnail" alt="">
                @else
                    <img src="" alt="">
                @endif
                <x-jet-secondary-button class="mt-2 mr-2" type="button">
                    <x-jet-input id="photo" wire:model="photo" type="file" class="hidden"/>
                    <label class="mb-0" for="photo" >
                        @if($photo)
                            {{ __('Cambia') }}
                        @else
                            {{ __('Seleziona') }}
                        @endif
                    </label>
                </x-jet-secondary-button>
                <x-jet-input-error for="photo" class="mt-2" />
            </div>
            <!--<div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                <h3>CIAO</h3>
            </div>-->

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" wire:model.defer="state.name" type="text" class="mt-1 block w-full" autocomplete="off" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <!-- Review -->
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="revisione" value="{{ __('Ultima revisione') }}" />
                <x-jet-input id="revisione" wire:model.defer="state.revisione" type="date" class="mt-1 w-full" />
                <x-jet-input-error for="revisione" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelAdd" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="confirmAdd" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- View machine info -->
    <x-jet-dialog-modal wire:model="stateModalInfo" >
        <x-slot name="title">
            {{ $state['name'] ?? '' }}
            <!--<x-jet-input wire:model.defer="state.name" />-->
        </x-slot>

        <x-slot name="content">
            <img src="{{ Storage::disk('public')->url($state['photo'] ?? '') }}" width="300" height="300" class="rounded img-thumbnail" alt="">

            <br/>

            {{ __('Ultima revisione: ') }}
            {{ date('d/m/Y', strtotime($state['revisione'] ?? '')) }}
            <!--{ $state['review'] ?? '' }}-->
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelInfo" wire:loading.attr="disabled">
                {{ __('Esci') }}
            </x-jet-secondary-button>

            <!--<x-jet-button class="ml-2" wire:click="updateRevision" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>-->
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Update revision date -->
    <x-jet-dialog-modal wire:model="stateModalRevision" >
        <x-slot name="title">
            {{ __('Modifica data ultima revisione') }}
        </x-slot>

        <x-slot name="content">
            <!--<div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">-->
            <!--<input type="date" class="mt-1 border border-gray-200 rounded-lg" value="<php echo date('d-m-Y')?>">-->
            <!--<input type="date" name="date" class="mt-1 border border-gray-200 rounded-lg">-->
            <x-jet-input type="date" wire:model.defer="state.date" autocomplete="off"></x-jet-input>
            <!--</div>-->
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelRevision" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="confirmUpdate" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete machine -->
    <x-jet-confirmation-modal wire:model="stateModalDelete" >
        <x-slot name="title">
            {{ __('Elimina macchina') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Rimuovendo la macchina tutti i dati ad essa associati verranno rimossi') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelDelete" wire:loading.attr="disabled">
                {{ __('Annulla') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="confirmDelete" wire:loading.attr="disabled">
                {{ __('Rimuovi') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
