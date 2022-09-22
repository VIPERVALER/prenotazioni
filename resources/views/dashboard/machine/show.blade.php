<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Macchine') }}
        </h2>
    </x-slot>

    <div>
    <!--<div class="py-12">-->
        <div class="max-w-7xl mx-auto pt-10 sm:px-6 lg:px-8">
        <!--<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">-->
            @livewire('machine-manager')
        </div>
    </div>

</x-app-layout>
