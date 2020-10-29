<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        // config(['database.connections.company_db.database' => 'qtour_comp' . Auth::user()->company_id . '_db']);
    }

    public function index()
    {

        return view('reservations.main');
    }

    public function new()
    {

        return view('reservations.new');
    }

    public function activities()
    {
        return view('reservations.profile');
    }
}
