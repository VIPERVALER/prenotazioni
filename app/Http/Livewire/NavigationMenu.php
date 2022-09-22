<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Machines;

class Navigationmenu extends Component
{
    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        //return view('navigation-menu');
        return view('navigation-menu', [
            'machines' => Machines::all(),
        ]);
    }
}
