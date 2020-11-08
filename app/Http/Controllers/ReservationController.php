<?php

namespace App\Http\Controllers;

use App\Models\CrewMember;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    private $items;
    private $db_conn;
    private $comp_db = "";
    private $app_db = "qtour_app_db";

    public function __construct()
    {
        $this->items = 20;
        $this->db_conn = 'company_db';

        $this->app_db = config('database.connections.app_db.database');
        $this->comp_db = config('database.connections.company_db.database');
    }

    public function index()
    {
        $data['title'] = 'Reservations';

        $data['reservations'] = DB::connection($this->db_conn)->table($this->comp_db . '.reservations')
            ->leftJoin($this->comp_db . '.crew_members', $this->comp_db . '.crew_members.id', '=', $this->comp_db . '.reservations.permit_holder')
            ->join($this->app_db . '.users', $this->app_db . '.users.id', '=', $this->comp_db . '.reservations.booked_by')
            ->leftJoin($this->comp_db . '.reservation_groups', $this->comp_db . '.reservation_groups.reservation_id', '=', $this->comp_db . '.reservations.id')
            ->select($this->comp_db . '.reservations.*', $this->app_db . '.users.first_name as u_fname', $this->app_db . '.users.last_name as u_lname', $this->comp_db . '.crew_members.first_name as cr_fname', $this->comp_db . '.crew_members.last_name as cr_lname', DB::raw('sum(' . $this->comp_db . '.reservation_groups.adults) as adults, sum(' . $this->comp_db . '.reservation_groups.children) as children, sum(' . $this->comp_db . '.reservation_groups.babies) as babies'))
            ->groupBy($this->comp_db . '.reservations.id')
            ->paginate($this->items);

        // echo "<pre>";
        // print_r(json_decode(json_encode($data), true));
        // die;
        //dd($data);

        return view('reservations.main', compact('data'));
    }

    public function new()
    {

        $data['title'] = 'New';
        $data['breadcrumbs'] = [
            ['url' => '/reservations', 'title' => 'Reservations']
        ];

        $data['drivers'] = DB::connection($this->db_conn)->table('crew_members')
            ->leftJoin('crew_on_reservations', function ($join) {
                $join->on('crew_members.id', '=', 'crew_on_reservations.member_id')
                    ->whereDate('crew_on_reservations.start_date', '<=', date('Y-m-d'))
                    ->whereDate('crew_on_reservations.end_date', '>=', date('Y-m-d'));
            })
            ->where('crew_members.job_title_id', '1')
            ->select('crew_members.id', 'crew_members.first_name', 'crew_members.last_name', 'crew_on_reservations.reservation_id')
            ->groupBy('crew_members.id')
            ->get();

        $data['bookers'] = User::select('id', 'first_name', 'last_name')->get();

        $data['groups'] = [];
        $data['names'] = [];
        $data['reservation'] = [];

        // $data['groups'] = DB::connection($this->db_conn)->table('reservation_groups')
        //     ->join('visitor_types', 'visitor_types.id', '=', 'reservation_groups.visitor_type_id')
        //     ->where('reservation_groups.reservation_id', '2')
        //     ->select('reservation_groups.*', 'visitor_types.type')
        //     ->orderBy('reservation_groups.id')
        //     ->get();

        // $data['names'] = DB::table($this->comp_db . '.reservation_names')
        //     ->join($this->app_db . '.world_countries', $this->app_db . '.world_countries.id', '=', $this->comp_db . '.reservation_names.country_id')
        //     ->where($this->comp_db . '.reservation_names.reservation_id', '2')
        //     ->select($this->comp_db . '.reservation_names.*', $this->app_db . '.world_countries.name')
        //     ->orderByDesc($this->comp_db . '.reservation_names.id')
        //     ->paginate($this->items);

        $data['countries'] = DB::table($this->app_db . '.world_countries')
            ->select('id', 'name')->get();

        // echo "<pre>";
        // print_r(json_decode(json_encode($data), true));
        // die;
        //dd($data);

        return view('reservations.new', compact('data'));
    }


    public function addReservation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_name' => 'required',
            'permit_holder' => 'required',
            'start_date' => 'required',
            'days' => 'required',
            'nights' => 'required'
        ]);

        if (!$validator->fails()) {

            $startDate = date('Y-m-d', strtotime($request->start_date));
            $endDate = date('Y-m-d', strtotime($request->end_date));
            $reservationId = $request->reservation_id;
            $reservationCode = $request->code;

            if (empty($request->code)) {
                $code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
                while (Reservation::where('code', $code)->count() > 0) {
                    $code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
                }
                $reservationCode = $code;
            }

            if (empty($reservationId)) {
                $reservationId = DB::connection($this->db_conn)->table('reservations')
                    ->insertGetId(
                        [
                            'group_name' => $request->group_name,
                            'permit_holder' => $request->permit_holder,
                            'booked_by' => $request->booked_by,
                            'code' => $reservationCode,
                            'start_date' => $startDate,
                            'end_date' => $endDate,
                            'nights' => $request->nights,
                        ]
                    );
            } else {
                DB::connection($this->db_conn)->table('reservations')
                    ->where('id', $reservationId)
                    ->update(
                        [
                            'group_name' => $request->group_name,
                            'permit_holder' => $request->permit_holder,
                            'booked_by' => $request->booked_by,
                            'start_date' => $startDate,
                            'end_date' => $endDate,
                            'nights' => $request->nights,
                        ]
                    );
            }

            // DB::connection($this->db_conn)->table('crew_on_reservations')->upsert([
            //     ['member_id' => $request->permit_holder, 'reservation_id' => $reservationId, 'start_date' =>
            //     $startDate, 'end_date' => $endDate]
            // ], ['reservation_id'], ['member_id', 'start_date', 'end_date']);

            DB::connection($this->db_conn)->table('crew_on_reservations')->updateOrInsert(
                [
                    'member_id' => $request->permit_holder,
                    'reservation_id' => $reservationId
                ],
                [
                    'start_date' => $startDate,
                    'end_date' => $endDate
                ]
            );

            // return response
            $response = [
                'success' => true,
                'message' => 'Reservation Added successfully.',
                'reservationId' => $reservationId,
                'reservationCode' => $code,
            ];
            return response()->json(
                $response,
                200
            );
        }

        $response = [
            'success' => false,
            'message' => $validator->errors()->all(),
        ];
        return response()->json($response, 200);
    }


    public function editReservation($reservationCode)
    {
        $data['title'] = 'Edit';
        $data['breadcrumbs'] = [
            ['url' => '/reservations', 'title' => 'Reservations']
        ];

        $reservation = Reservation::where('code', $reservationCode)->first();
        $data['reservation'] = $reservation;

        $data['groups'] = DB::connection($this->db_conn)->table('reservation_groups')
            ->join('visitor_types', 'visitor_types.id', '=', 'reservation_groups.visitor_type_id')
            ->where('reservation_groups.reservation_id', $reservation['id'])
            ->select('reservation_groups.*', 'visitor_types.type')
            ->get();


        $data['names'] = DB::table($this->comp_db . '.reservation_names')
            ->join($this->app_db . '.world_countries', $this->app_db . '.world_countries.id', '=', $this->comp_db . '.reservation_names.country_id')
            ->where($this->comp_db . '.reservation_names.reservation_id', $reservation['id'])
            ->select($this->comp_db . '.reservation_names.*', $this->app_db . '.world_countries.name')
            ->orderByDesc($this->comp_db . '.reservation_names.id')
            ->paginate($this->items);

        $data['drivers'] = DB::connection($this->db_conn)->table('crew_members')
            ->leftJoin('crew_on_reservations', function ($join) {
                $join->on('crew_members.id', '=', 'crew_on_reservations.member_id')
                    ->whereDate('crew_on_reservations.start_date', '<=', date('Y-m-d'))
                    ->whereDate('crew_on_reservations.end_date', '>=', date('Y-m-d'));
            })
            ->where('crew_members.job_title_id', '1')
            ->select('crew_members.id', 'crew_members.first_name', 'crew_members.last_name', 'crew_on_reservations.reservation_id')
            ->groupBy('crew_members.id')
            ->get();

        $data['bookers'] = User::select('id', 'first_name', 'last_name')->get();

        $data['countries'] = DB::table($this->app_db . '.world_countries')
            ->select('id', 'name')->get();

        // echo "<pre>";
        // print_r(json_decode(json_encode($data), true));
        // die;
        //dd($data);

        return view('reservations.new', compact('data'));
    }

    public function addGroup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'visitor_type' => 'required',
            'adults' => 'required',
        ]);

        if (!$validator->fails()) {

            DB::connection($this->db_conn)->table('reservation_groups')->updateOrInsert(
                [
                    'visitor_type_id' => $request->visitor_type,
                    'reservation_id' => $request->reservation
                ],
                [
                    'adults' => $request->adults,
                    'children' => $request->children,
                    'babies' => $request->babies
                ]
            );


            $groups = DB::connection($this->db_conn)->table('reservation_groups')
                ->join('visitor_types', 'visitor_types.id', '=', 'reservation_groups.visitor_type_id')
                ->where('reservation_groups.reservation_id', $request->reservation)
                ->select('reservation_groups.*', 'visitor_types.type')
                ->get();


            $updatedView = view('reservations.group-table-row', compact('groups'))->render();
            // return response

            $response = [
                'success' => true,
                'message' => 'Group Added successfully.',
                'updatedGroups' => $updatedView
            ];
            return response()->json(
                $response,
                200
            );
        }

        $response = [
            'success' => false,
            'message' => $validator->errors()->all(),
        ];
        return response()->json($response, 200);
    }


    public function editGroup($groupId)
    {
        $data['group'] = DB::connection($this->db_conn)->table('reservation_groups')
            ->where('id', $groupId)
            ->get();

        return response()->json($data);
    }

    public function deleteGroup(Request $request)
    {
        $data['group'] = DB::connection($this->db_conn)->table('reservation_groups')
            ->where('id', $request->group_id)
            ->delete();

        $groups = DB::connection($this->db_conn)->table('reservation_groups')
            ->join('visitor_types', 'visitor_types.id', '=', 'reservation_groups.visitor_type_id')
            ->where('reservation_groups.reservation_id', $request->reservation_id)
            ->select('reservation_groups.*', 'visitor_types.type')
            ->get();


        $data['updatedGroups'] = view('reservations.group-table-row', compact('groups'))->render();
        return response()->json($data);
    }

    public function addVisitor(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'gender' => 'required',
            'country' => 'required',
        ]);

        if (!$validator->fails()) {

            DB::connection($this->db_conn)->table('reservation_names')->updateOrInsert(
                [
                    'id' => $request->visitor_id
                ],
                [
                    'full_name' => $request->full_name,
                    'country_id' => $request->country,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'other_contact' => $request->other_contact,
                    'reservation_id' => $request->reservation
                ]
            );

            $names = DB::table($this->comp_db . '.reservation_names')
                ->join($this->app_db . '.world_countries', $this->app_db . '.world_countries.id', '=', $this->comp_db . '.reservation_names.country_id')
                ->where($this->comp_db . '.reservation_names.reservation_id', $request->reservation)
                ->select($this->comp_db . '.reservation_names.*', $this->app_db . '.world_countries.name')
                ->orderByDesc($this->comp_db . '.reservation_names.id')
                ->paginate($this->items);

            $updatedView = view('reservations.visitor-names', compact('names'))->render();

            $response = [
                'success' => true,
                'message' => 'Visitor Added successfully.',
                'updatedVisitors' => $updatedView
            ];
            return response()->json(
                $response,
                200
            );
        }

        $response = [
            'success' => false,
            'message' => $validator->errors()->all(),
        ];
        return response()->json($response, 200);
    }

    public function editVisitor($visitorId)
    {
        $data['visitor'] = DB::connection($this->db_conn)->table('reservation_names')
            ->where('id', $visitorId)
            ->get();

        return response()->json($data);
    }


    public function deleteVisitor(Request $request)
    {
        $data['visitor'] = DB::connection($this->db_conn)->table('reservation_names')
            ->where('id', $request->visitor_id)
            ->delete();


        $names = DB::table($this->comp_db . '.reservation_names')
            ->join($this->app_db . '.world_countries', $this->app_db . '.world_countries.id', '=', $this->comp_db . '.reservation_names.country_id')
            ->where($this->comp_db . '.reservation_names.reservation_id', $request->reservation_id)
            ->select($this->comp_db . '.reservation_names.*', $this->app_db . '.world_countries.name')
            ->orderByDesc($this->comp_db . '.reservation_names.id')
            ->paginate($this->items);

        $data['updatedVisitors'] = view('reservations.visitor-names', compact('names'))->render();

        return response()->json($data);
    }
}
