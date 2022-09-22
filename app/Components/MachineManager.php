<?php

namespace App\Components;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;
use App\Models\Machines;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class MachineManager extends Component
{
    use WithFileUploads;

    public $state = [];

    public $machines;
    public $stateModalAdd = false;
    public $stateModalInfo = false;
    public $stateModalRevision = false;
    public $stateModalDelete = false;
    public $photo;

    public $machine = null;

    //

    public function modalAdd()
    {
        $this->photo = null;
        $this->state = [];
        $this->stateModalAdd = true;
    }
    public function cancelAdd()
    {
        $this->stateModalAdd = false;
    }
    public function confirmAdd() {
        //$this->state['team']=Auth::user()->currentTeam->id;
        $this->state['photo']=$this->photo;
        $this->state['name']=strtoupper($this->state['name']);
        $validate = Validator::make($this->state, [
            'name' => ['required', 'string', 'max:255', Rule::unique('machines')->where('team',Auth::user()->currentTeam->id)],
            'revisione' => ['required', 'date', 'date_format:Y-m-d', 'before_or_equal:today'],
            'photo' => ['required', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validate();
        //$validate['name']=strtoupper($validate['name']);
        $validate['photo'] = $this->photo->store('/testImg', 'public');
        //dd($validate['photo']);
        if (count(Machines::all())<1)
            $this->emit('refresh-navigation-menu');
        Machines::create($validate);
        $this->stateModalAdd = false;
    }

    public function modalInfo(Machines $machine)
    {
        $this->machine = $machine;
        $this->state['name'] = $machine->name;
        $this->state['photo'] = $machine->photo;
        $this->state['revisione'] = $machine->revisione;
        $this->stateModalInfo = true;
    }
    public function cancelInfo()
    {
        $this->stateModalInfo = false;
    }

    public function modalRevision(Machines $machine)
    {
        $this->machine = $machine;
        $this->state['date'] = $machine->revisione;
        $this->stateModalRevision = true;
    }
    public function cancelRevision()
    {
        $this->stateModalRevision = false;
    }
    public function confirmUpdate()
    {
        Validator::make($this->state, [
            'date' => ['required', 'date', 'date_format:Y-m-d', 'before:tomorrow'],
        ])->validate();
        Machines::updateReview($this->machine->id, $this->state['date']);
        $this->stateModalRevision = false;
    }

    public function modalDelete($machine)
    {
        $this->machine = $machine;
        $this->stateModalDelete = true;
        //dd($machineId);
    }
    public function cancelDelete()
    {
        $this->stateModalDelete = false;
    }
    public function confirmDelete()
    {
        //dd($this->machine);$machine = Machines::findOrFail($this->machine);$machine->delete();
        Machines::deleteMachine($this->machine);
        if (count(Machines::all())<1)
            $this->emit('refresh-navigation-menu');

        $this->stateModalDelete = false;
    }

    /*public function mount()
    {
        $this->machines = Machines::all();
    }*/

    public function render()
    {
        $this->machines = Machines::all();
        //$this->machines = Machines::where('team',Auth::user()->currentTeam->id)->get();
        return view('dashboard.machine.machine-manager');
    }
}
