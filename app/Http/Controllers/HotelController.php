<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    private $items;

    public function __construct()
    {
        $this->items = 20;
        $this->db_conn = 'company_db';
    }


    public function index()
    {
        $data['title'] = 'Parks';

        $app_db = config('database.connections.app_db.database');
        $comp_db = config('database.connections.company_db.database');

        $data['regions'] = DB::table($app_db . '.tz_regions')->get();
        $data['hotels'] = DB::connection('company_db')->table('hotels')
            ->select('name', 'photo')
            ->paginate($this->items);

        // echo "<pre>";
        // print_r(json_decode(json_encode($data), true));
        // die;
        //dd($data);

        return view('hotels.main', compact('data'));
    }
}
