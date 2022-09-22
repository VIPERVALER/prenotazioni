<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Aggiorna password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Utilizza una password lunga e casuale per rendere sicuro il tuo account, ricordati di cambiare frequentemente la password.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4 pt-2">
            <x-jet-label for="current_password" value="{{ __('Password attuale') }}" />
            <x-jet-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-jet-input-error for="current_password" class="mt-2" />
            <!--<div class="border-b py-2 border-gray-300"></div>-->
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password" value="{{ __('Nuova password') }}" />
            <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password_confirmation" value="{{ __('Conferma password') }}" />
            <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-jet-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Salvata.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Salva') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
