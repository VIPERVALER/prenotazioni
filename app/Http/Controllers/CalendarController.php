<?php

namespace App\Http\Controllers;

use App\Models\Machines;

class CalendarController extends Controller
{

    public function render()
    {
        //return view('dashboard.calendar.show', ['machine'=>Machines::first()->id]);
        return view('dashboard.calendar.show');
        //return redirect()->route('profile.show');
    }

}
