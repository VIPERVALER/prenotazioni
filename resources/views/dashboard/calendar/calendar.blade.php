<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-15 bg-white border-b border-gray-200">
                <div class="d-flex flex-wrap justify-content-end">
                    <select class="custom-select col-3 d-none d-lg-block mr-auto mt-2" wire:model="MachineSelected">
                        @foreach($machines as $machine)
                            <option value="{{ $machine->id }}">{{ $machine->name }}</option>
                        @endforeach
                    </select>
                    <select class="custom-select d-lg-none" wire:model="MachineSelected">
                        @foreach($machines as $machine)
                            <option value="{{ $machine->id }}">{{ $machine->name }}</option>
                        @endforeach
                    </select>
                    <!--<select class="custom-select sm:w-25 " wire:model="MachineSelected">
                        @foreach($machines as $machine)
                            <option value="{{ $machine->id }}" class="w-12">{{ $machine->name }}</option>
                        @endforeach
                    </select>-->
                    <ul class="d-flex mt-sm-2 pagination">
                        <li id="prev" class="page-item">
                            @if($WeekSelected==0)
                                <x-jet-secondary-button class="prev page-link" wire:click="week(-1)" disabled>
                                    <!--{ __('Precedente') }}-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
                                        <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
                                    </svg>
                                </x-jet-secondary-button>
                            @else
                                <x-jet-secondary-button class="prev page-link" wire:click="week(-1)">
                                    <!--{ __('Precedente') }}-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
                                        <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
                                    </svg>
                                </x-jet-secondary-button>
                            @endif
                        </li>
                        <li id="next" class="page-item">
                            @if($WeekSelected==17)
                                <x-jet-secondary-button class="next page-link" wire:click="week(1)" disabled>
                                    <!--{ __('Successivo') }}-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right" viewBox="0 0 16 16">
                                        <path d="M6 12.796V3.204L11.481 8 6 12.796zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
                                    </svg>
                                </x-jet-secondary-button>
                            @else
                                <x-jet-secondary-button class="next page-link" wire:click="week(1)">
                                    <!--{ __('Successivo') }}-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right" viewBox="0 0 16 16">
                                        <path d="M6 12.796V3.204L11.481 8 6 12.796zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
                                    </svg>
                                </x-jet-secondary-button>
                            @endif
                        </li>
                    </ul>
                </div>

                <div class="wrapper overflow-auto">
                    <table class="table table-bordered" style="text-align: center">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            @foreach($days as $day)
                                <th scope="col">
                                    <div class="slideshow-container">
                                        <p class="lead" >{{ $day['name'] }}</p>
                                        <div class="mySlides">
                                            <h5 class="card-title">{{ date('d/m/Y', strtotime($day['date'])) }}</h5>
                                        </div>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row" class="align-middle" style="z-index: 100;">AM</th>
                            @foreach($days as $day)
                                <td>
                                    <div class="card-body">
                                        <?php $found=[] ?>
                                        @foreach($prenotations as $reserve)
                                            @if($reserve->date===$day['date'] && $reserve->when==='AM')
                                                <?php $found=$reserve ?>
                                            @endif
                                        @endforeach
                                        @empty($found)
                                            <x-jet-button class="bg-blue-500 hover:bg-blue-700 align-middle" wire:click='bookModal({{ "\"$day[date]\"" }},{{ "\"AM\"" }})' >{{ __('Prenota') }}</x-jet-button>
                                        @else
                                            <p class="d-flex justify-content-center">{{ $found->work }}</p>
                                            <span class="d-flex object-center">
                                                <x-jet-button class="bg-green-500 hover:bg-green-600" wire:click='bookModal({{ "\"$found->date\"" }},{{ "\"$found->when\"" }})'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                                    </svg>
                                                </x-jet-button>
                                                <x-jet-button class="bg-red-500 hover:bg-red-600" wire:click='deleteModal({{ "\"$found->date\"" }},{{ "\"$found->when\"" }})'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                </x-jet-button>
                                                <x-jet-button class="bg-gray-500 hover:bg-gray-600" wire:click='updateModal({{ "\"$found->date\"" }},{{ "\"$found->when\"" }})'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                    </svg>
                                                </x-jet-button>
                                            </span>
                                        @endempty
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row" class="align-middle" style="z-index: 100;">PM</th>
                            @foreach($days as $day)
                                <td>
                                    <div class="card-body">
                                        <?php $found=[] ?>
                                        @foreach($prenotations as $reserve)
                                            @if($reserve->date===$day['date'] && $reserve->when==='PM')
                                                <?php $found=$reserve ?>
                                            @endif
                                        @endforeach
                                        @empty($found)
                                            <x-jet-button class="bg-blue-500 hover:bg-blue-700" wire:click='bookModal({{ "\"$day[date]\"" }},{{ "\"PM\"" }})' >{{ __('Prenota') }}</x-jet-button>
                                        @else
                                            <p class="d-flex justify-content-center">{{ $found->work }}</p>
                                                <span class="d-flex object-center">
                                                <x-jet-button class="bg-green-500 hover:bg-green-600" wire:click='bookModal({{ "\"$found->date\"" }},{{ "\"$found->when\"" }})'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                                    </svg>
                                                </x-jet-button>
                                                <x-jet-button class="bg-red-500 hover:bg-red-600" wire:click='deleteModal({{ "\"$found->date\"" }},{{ "\"$found->when\"" }})'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                </x-jet-button>
                                                <x-jet-button class="bg-gray-500 hover:bg-gray-600" wire:click='updateModal({{ "\"$found->date\"" }},{{ "\"$found->when\"" }})'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                    </svg>
                                                </x-jet-button>
                                            </span>
                                        @endempty
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="stateModalDelete" >
        <x-slot name="title">
            {{ __('Elimina prenotazione') }}
        </x-slot>

        <x-slot name="content">
            <!--<div class="col-span-6 sm:col-span-4 mt-4">

            </div>-->
            <!--<div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                <h3>CIAO</h3>
            </div>-->

            <div class="col-span-6 sm:col-span-4 mt-4">
                <p>Vuoi far scalare le prenotazioni al giorno precedente?</p>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelDelete" wire:loading.attr="disabled">
                {{ __('Annulla') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2 bg-blue-500 hover:bg-blue-700" wire:click="confirmDelete(false)" wire:loading.attr="disabled">
                {{ __('No') }}
            </x-jet-button>

            <x-jet-button class="ml-2" wire:click="confirmDelete(true)" wire:loading.attr="disabled">
                {{ __('Si') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="stateModalBook" >
        <x-slot name="title">
            {{ __('Aggiungi prenotazione') }}
        </x-slot>

        <x-slot name="content">
            <!--<div class="col-span-6 sm:col-span-4 mt-4">

            </div>-->
            <!--<div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                <h3>CIAO</h3>
            </div>-->

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="work" value="{{ __('Lavorazione:') }}" />
                <x-jet-input id="work" wire:model.defer="state.work" type="text" class="mt-1 block w-full" autocomplete="off" autofocus/>
                <x-jet-input-error for="work" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelBook" wire:loading.attr="disabled">
                {{ __('Annulla') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="confirmBook" wire:loading.attr="disabled">
                {{ __('Salva') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="stateModalUpdate" >
        <x-slot name="title">
            {{ __('Modifica prenotazione') }}
        </x-slot>

        <x-slot name="content">
            <!--<div class="col-span-6 sm:col-span-4 mt-4">

            </div>-->
            <!--<div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                <h3>CIAO</h3>
            </div>-->

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-jet-label for="work" value="{{ __('Lavorazione:') }}" />
                <x-jet-input id="work" wire:model.defer="state.work" type="text" class="mt-1 block w-full" autocomplete="off" autofocus/>
                <x-jet-input-error for="work" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelUpdate" wire:loading.attr="disabled">
                {{ __('Annulla') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="confirmUpdate" wire:loading.attr="disabled">
                {{ __('Salva') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>

