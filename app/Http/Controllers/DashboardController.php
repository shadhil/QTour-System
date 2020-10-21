<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['breadcrumbs'] = [
            ['url' => '/user', 'title' => 'Mid Page']
        ];

        return view('pages.dashboard', $data);
    }
}
