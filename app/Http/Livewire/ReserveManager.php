<?php


namespace App\Http\Livewire;


use App\Models\Machines;
use App\Models\Reservations;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ReserveManager extends Component
{
    use WithPagination;
    //protected $paginationTheme = 'bootstrap';

    public $machineSelected;
    public $machines;

    public function mount()
    {
        if (count(Machines::all())<1)
            return redirect()->route('machine');
        $this->machines = Machines::all();
        $this->machineSelected = Machines::first()->id;
    }

    public function render()
    {
        return view('dashboard.reserve.reserve', ['reservations' => Reservations::whereMachine($this->machineSelected)->paginate(10)]);
    }

}
