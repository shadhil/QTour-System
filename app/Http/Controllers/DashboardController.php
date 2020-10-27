<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        //config(['database.connections.company_db.database' => 'qtour_comp' . Auth::user()->company_id . '_db']);
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['breadcrumbs'] = [
            ['url' => '/user', 'title' => 'Mid Page']
        ];

        config(['database.connections.company_db.database' => 'qtour_comp' . Auth::user()->company_id . '_db']);
        //return config('database.connections.company_db.database');
        return view('pages.dashboard', $data);
    }
}
