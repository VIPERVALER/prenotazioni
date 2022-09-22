<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <select class="custom-select col-3 d-none d-lg-block mr-auto mt-2" wire:model="machineSelected">
                    @foreach($machines as $machine)
                        <option value="{{ $machine->id }}">{{ $machine->name }}</option>
                    @endforeach
                </select>
                <select class="custom-select d-lg-none" wire:model="machineSelected">
                    @foreach($machines as $machine)
                        <option value="{{ $machine->id }}">{{ $machine->name }}</option>
                    @endforeach
                </select>

                <br/>

                @foreach ($reservations as $reserve)
                    <div class="sm:flex bg-gray-50 rounded-xl sm:p-0 mt-2">
                        <div class="grid grid-cols-1 sm:grid-cols-2 p-2 md:p-4 text-center">
                            <div class="text-gray-500 pr-3 sm:border-r-2 border-r-0">
                                {{ $reserve->date."\t".$reserve->when }}
                            </div>
                            <p class="text-lg font-semibold m-0">
                                {{ $reserve->work }}
                            </p>
                        </div>
                    </div>
                @endforeach

                {{ $reservations->links() }}
            </div>
        </div>
    </div>
</div>
