<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendario') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!--livewire('dashboard.calendar.calendar')-->
            {{--<livewire:calendar-manager />--}}
            @livewire('calendar-manager', ['machine'=>$machine, 'week'=>$week])
        </div>
    </div>

</x-app-layout>
