<x-jet-action-section>
    <x-slot name="title">
        {{ __('Elimina account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Eliminazione permanente.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 pt-2">
            {{ __('Una volta cancellato l\'account tutti i dati ad esso associali verranno irrevocabilmente eliminati.') }}
        </div>

        <!--<div class="mt-5">-->
        <div class="mt-4 pb-2">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Elimina') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Elimina account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Sei sicuro di voler eliminare il tuo account? Una volta cancellato l\'account tutti i dati ad esso associali verranno irrevocabilmente eliminati. Inserisci la tua password per confermare.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Annulla') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Conferma') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
