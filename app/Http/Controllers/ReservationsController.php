<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function render()
    {
        return view('dashboard.reserve.show');
    }
}
