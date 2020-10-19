<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservations.main');
    }

    public function new()
    {
        return view('reservations.new');
    }
}
