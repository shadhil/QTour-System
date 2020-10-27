<?php

namespace App\Http\Controllers;

use App\Models\CrewMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrewController extends Controller
{
    private $items;
    private $db_conn;

    public function __construct()
    {
        $this->items = 20;
        $this->db_conn = 'company_db';
    }


    public function index()
    {
        $data['title'] = 'Drivers & Crew';

        $data['members'] = DB::connection($this->db_conn)->table('crew_members')
            ->join('crew_job_titles', 'crew_members.job_title_id', 'crew_job_titles.id')
            ->leftJoin('crew_on_reservations', function ($join) {
                $join->on('crew_members.id', '=', 'crew_on_reservations.member_id')
                    ->whereDate('crew_on_reservations.start_date', '<=', date('Y-m-d'))
                    ->whereDate('crew_on_reservations.end_date', '>=', date('Y-m-d'));
            })
            ->select('crew_members.*', 'crew_job_titles.job_title', 'crew_on_reservations.reservation_id')
            ->groupBy('crew_members.id')
            ->paginate($this->items);

        // echo "<pre>";
        // print_r(json_decode(json_encode($data), true));
        // die;
        //dd($data);

        return view('drivers_crew.main', compact('data'));
    }
}
