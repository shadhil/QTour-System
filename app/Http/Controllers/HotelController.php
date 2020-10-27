<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    private $items;

    public function __construct()
    {
        $this->items = 20;
    }

    public function index()
    {
        $data['title'] = 'Hotels';

        $hotels = Hotel::orderBy('id', 'desc')->paginate($this->items);
        $data['hotels'] = $hotels; //json_encode($users);

        //echo "<pre>";
        //print_r(json_decode(json_encode($data), true));
        //die;
        //dd($data);

        return view('hotels.main', compact('data'));
    }
}
