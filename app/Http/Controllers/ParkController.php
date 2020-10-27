<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParkController extends Controller
{
    private $items;
    private $db_conn;
    private $db_app_conn;

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
        $data['parks'] = DB::table($comp_db . '.parks')
            ->join($app_db . '.tz_regions', $comp_db . '.parks.region_id', $app_db . '.tz_regions.id')
            ->select($comp_db . '.parks.park_name', $app_db . '.tz_regions.region')
            ->paginate($this->items);

        // echo "<pre>";
        // print_r(json_decode(json_encode($data), true));
        // die;
        //dd($data);

        return view('parks.main', compact('data'));
    }
}
