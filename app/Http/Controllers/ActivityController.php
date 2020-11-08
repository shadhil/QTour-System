<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
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

    public function activities($reservationCode)
    {
        $data['title'] = 'Activities';
        $data['breadcrumbs'] = [
            ['url' => '/reservations', 'title' => 'Reservations']
        ];


        $data['reservation'] = DB::connection($this->db_conn)->table($this->comp_db . '.reservations')
            ->leftJoin($this->comp_db . '.crew_members', $this->comp_db . '.crew_members.id', '=', $this->comp_db . '.reservations.permit_holder')
            ->join($this->app_db . '.users', $this->app_db . '.users.id', '=', $this->comp_db . '.reservations.booked_by')
            ->leftJoin($this->comp_db . '.reservation_groups', $this->comp_db . '.reservation_groups.reservation_id', '=', $this->comp_db . '.reservations.id')
            ->select($this->comp_db . '.reservations.*', $this->app_db . '.users.first_name as u_fname', $this->app_db . '.users.last_name as u_lname', $this->comp_db . '.crew_members.first_name as cr_fname', $this->comp_db . '.crew_members.last_name as cr_lname', DB::raw('sum(' . $this->comp_db . '.reservation_groups.adults) as tot_adults, sum(' . $this->comp_db . '.reservation_groups.children) as tot_children, sum(' . $this->comp_db . '.reservation_groups.babies) as tot_babies'))
            ->where($this->comp_db . '.reservations.code', $reservationCode)
            ->first();

        $data['visitor_types'] = DB::connection($this->db_conn)->table('reservation_groups')
            ->where('reservation_id', $data['reservation']->id)
            ->pluck('visitor_type_id')
            ->toArray();


        $data['day_parks'] = DB::connection($this->db_conn)->table('reservation_activities')
            ->join('park_activities', 'park_activities.id', '=', 'reservation_activities.park_activity_id')
            ->join('parks', 'park_activities.park_id', '=', 'parks.id')
            ->where('reservation_activities.reservation_id', $data['reservation']->id)
            ->select(DB::raw('DISTINCT reservation_activities.day, park_activities.park_id'), 'parks.park_name')
            ->get();

        $data['parks'] = DB::connection($this->db_conn)->table('parks')
            ->select('id', 'park_name')
            ->get();


        $data['rsrv_activities'] = DB::connection($this->db_conn)->table('reservation_activities')
            ->join('park_activities', 'park_activities.id', '=', 'reservation_activities.park_activity_id')
            ->join('activities', 'activities.id', '=', 'park_activities.activity_id')
            ->join('parks', 'parks.id', '=', 'park_activities.park_id')
            ->join('visitor_types', 'visitor_types.id', '=', 'park_activities.type_id')
            ->leftJoin('activity_categories', 'activity_categories.id', '=', 'park_activities.category_id')
            ->where('reservation_activities.reservation_id', $data['reservation']->id)
            ->select('reservation_activities.*', 'park_activities.activity_id', 'park_activities.category_id', 'park_activities.type_id', 'park_activities.park_id', 'visitor_types.type', 'activities.activity', 'activity_categories.category', 'parks.park_name')
            ->paginate($this->items);

        // $data['park_activities'] = DB::connection($this->db_conn)->table('park_activities')
        //     ->join('activities', 'activities.id', '=', 'park_activities.activity_id')
        //     ->leftJoin('activity_categories', 'activity_categories.id', '=', 'park_activities.category_id')
        //     ->where('park_activities.park_id', '1')
        //     ->select('park_activities.*', 'activities.activity', 'activity_categories.category')
        //     ->get();

        // echo "<pre>";
        // print_r(json_decode(json_encode($data['rsrv_activities']), true));
        // die;

        return view('reservations.profile', compact('data'));
    }


    public function loadParkActivities($parkId)
    {
        $parkActivities = DB::connection($this->db_conn)->table('park_activities')
            ->join('activities', 'activities.id', '=', 'park_activities.activity_id')
            ->leftJoin('activity_categories', 'activity_categories.id', '=', 'park_activities.category_id')
            ->where('park_activities.park_id', $parkId)
            ->select('park_activities.*', 'activities.activity', 'activity_categories.category')
            ->get();

        if (sizeof($parkActivities) > 0) {
            $response = [
                'success' => true,
                'message' => 'Activities Loaded Successfully.',
                'park_activities' => $parkActivities
            ];
            return response()->json(
                $response,
                200
            );
        }

        $response = [
            'success' => false,
            'message' => 'No Activity Found.',
            'park_activities' => []
        ];
        return response()->json(
            $response,
            200
        );
    }


    public function addActivity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'required',
            'park' => 'required',
            'activity' => 'required',
            'category' => 'required',
        ]);

        if (!$validator->fails()) {

            $eastAfrican = $request->east_african == '' ? '0' : $request->east_african;
            $expatriate = $request->expatriate == '' ? '0' : $request->expatriate;
            $nonResident = $request->non_resident == '' ? '0' : $request->non_resident;

            if ($eastAfrican == '0' && $request->action == 'update') {

                DB::connection($this->db_conn)->table('reservation_activities')
                    ->where('id', $request->ea_activity_id)
                    ->delete();
            } elseif ($eastAfrican != '0' || $request->action == 'update') {
                $activityId = $request->ea_activity_id;

                $activity = DB::connection($this->db_conn)->table('reservation_activities')
                    ->join('park_activities', 'park_activities.id', '=', 'reservation_activities.park_activity_id')
                    ->where([
                        ['reservation_activities.reservation_id', '=', $request->reservation_id],
                        ['reservation_activities.day', '=', $request->day],
                        ['park_activities.park_id', '=', $request->park],
                        ['park_activities.category_id', '=', $request->category],
                        ['park_activities.type_id', '=', '1']
                    ])
                    ->select('reservation_activities.id', 'reservation_activities.pax')
                    ->first();

                if ($activity) {
                    if ((int)$activity->pax > 0) {
                        $eastAfrican = (int)$eastAfrican + (int)$activity->pax;
                        $activityId = $activity->id;
                    }
                }


                $totalPrice = (float)$eastAfrican * (float)$request->ea_price;
                DB::connection($this->db_conn)->table('reservation_activities')->updateOrInsert(
                    [
                        'id' => $activityId
                    ],
                    [
                        'park_activity_id' => $request->ea_park_activity_id,
                        'pax' => $eastAfrican,
                        'day' => $request->day,
                        'price' => $request->ea_price,
                        'total_price' => $totalPrice,
                        'currency' => $request->currency,
                        'reservation_id' => $request->reservation_id
                    ]
                );
            }


            if ($expatriate == '0' && $request->action == 'update') {

                DB::connection($this->db_conn)->table('reservation_activities')
                    ->where('id', $request->ex_activity_id)
                    ->delete();
            } elseif ($expatriate != '0' || $request->action == 'update') {
                $activityId = $request->ex_activity_id;

                $activity = DB::connection($this->db_conn)->table('reservation_activities')
                    ->join('park_activities', 'park_activities.id', '=', 'reservation_activities.park_activity_id')
                    ->where([
                        ['reservation_activities.reservation_id', '=', $request->reservation_id],
                        ['reservation_activities.day', '=', $request->day],
                        ['park_activities.park_id', '=', $request->park],
                        ['park_activities.category_id', '=', $request->category],
                        ['park_activities.type_id', '=', '2']
                    ])
                    ->select('reservation_activities.id', 'reservation_activities.pax')
                    ->first();

                if ((int)$activity->pax > 0) {
                    $expatriate = (int)$expatriate + (int)$activity->pax;
                    $activityId = $activity->id;
                }

                $totalPrice = (float)$expatriate * (float)$request->ex_price;
                DB::connection($this->db_conn)->table('reservation_activities')->updateOrInsert(
                    [
                        'id' => $activityId
                    ],
                    [
                        'park_activity_id' => $request->ex_park_activity_id,
                        'pax' => $expatriate,
                        'day' => $request->day,
                        'price' => $request->ex_price,
                        'total_price' => $totalPrice,
                        'currency' => $request->currency,
                        'reservation_id' => $request->reservation_id
                    ]
                );
            }



            if ($nonResident == '0' && $request->action == 'update') {

                DB::connection($this->db_conn)->table('reservation_activities')
                    ->where('id', $request->nr_activity_id)
                    ->delete();
            } elseif ($nonResident != '0' || $request->action == 'update') {
                $activityId = $request->nr_activity_id;

                $activity = DB::connection($this->db_conn)->table('reservation_activities')
                    ->join('park_activities', 'park_activities.id', '=', 'reservation_activities.park_activity_id')
                    ->where([
                        ['reservation_activities.reservation_id', '=', $request->reservation_id],
                        ['reservation_activities.day', '=', $request->day],
                        ['park_activities.park_id', '=', $request->park],
                        ['park_activities.category_id', '=', $request->category],
                        ['park_activities.type_id', '=', '3']
                    ])
                    ->select('reservation_activities.id', 'reservation_activities.pax')
                    ->first();

                if ((int)$activity->pax > 0) {
                    $nonResident = (int)$nonResident + (int)$activity->pax;
                    $activityId = $activity->id;
                }
                $totalPrice = (float)$nonResident * (float)$request->nr_price;
                DB::connection($this->db_conn)->table('reservation_activities')->updateOrInsert(
                    [
                        'id' => $activityId
                    ],
                    [
                        'park_activity_id' => $request->nr_park_activity_id,
                        'pax' => $nonResident,
                        'day' => $request->day,
                        'price' => $request->nr_price,
                        'total_price' => $totalPrice,
                        'currency' => $request->currency,
                        'reservation_id' => $request->reservation_id
                    ]
                );
            }


            $rsrvActivities = DB::connection($this->db_conn)->table('reservation_activities')
                ->join('park_activities', 'park_activities.id', '=', 'reservation_activities.park_activity_id')
                ->join('activities', 'activities.id', '=', 'park_activities.activity_id')
                ->join('parks', 'parks.id', '=', 'park_activities.park_id')
                ->join('visitor_types', 'visitor_types.id', '=', 'park_activities.type_id')
                ->leftJoin('activity_categories', 'activity_categories.id', '=', 'park_activities.category_id')
                ->where('reservation_activities.reservation_id', $request->reservation_id)
                ->select('reservation_activities.*', 'park_activities.activity_id', 'park_activities.category_id', 'park_activities.type_id', 'park_activities.park_id', 'visitor_types.type', 'activities.activity', 'activity_categories.category', 'parks.park_name')
                ->paginate($this->items);
            $updatedView1 = view('reservations.activity-table', compact('rsrvActivities'))->render();

            $dayParks = DB::connection($this->db_conn)->table('reservation_activities')
                ->join('park_activities', 'park_activities.id', '=', 'reservation_activities.park_activity_id')
                ->join('parks', 'park_activities.park_id', '=', 'parks.id')
                ->where('reservation_activities.reservation_id', $request->reservation_id)
                ->select(DB::raw('DISTINCT reservation_activities.day, park_activities.park_id'), 'parks.park_name')
                ->get();
            $updatedView2 = view('reservations.day-park', compact('dayParks'))->render();

            // return response
            $response = [
                'success' => true,
                'message' => 'Reservation Added successfully.',
                'reservationActivities' => $updatedView1,
                'dayParkLinks' => $updatedView2,
                //'reservationCode' => $code,
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


    public function loadActivityInfo(Request $request)
    {
        $activities = DB::connection($this->db_conn)->table('reservation_activities')
            ->join('park_activities', 'park_activities.id', '=', 'reservation_activities.park_activity_id')
            ->where([
                ['reservation_activities.reservation_id', '=', $request->reservation_id],
                ['reservation_activities.day', '=', $request->day],
                ['park_activities.park_id', '=', $request->park_id],
                ['park_activities.category_id', '=', $request->category_id]
            ])
            ->select('reservation_activities.*', 'park_activities.type_id', 'park_activities.price_tzs', 'park_activities.price_usd')
            ->get();

        if (sizeof($activities) > 0) {
            $response = [
                'success' => true,
                'message' => 'Activities Loaded Successfully.',
                'activities' => $activities
            ];
            return response()->json(
                $response,
                200
            );
        }

        $response = [
            'success' => false,
            'message' => 'No Activity Found.',
            'activities' => []
        ];
        return response()->json(
            $response,
            200
        );
    }


    public function deleteActivity(Request $request)
    {
        $data['activity'] = DB::connection($this->db_conn)->table('reservation_activities')
            ->join('park_activities', 'park_activities.id', '=', 'reservation_activities.park_activity_id')
            ->where([
                ['reservation_activities.reservation_id', '=', $request->reservation_id],
                ['reservation_activities.day', '=', $request->day],
                ['park_activities.park_id', '=', $request->park_id],
                ['park_activities.category_id', '=', $request->category_id]
            ])
            ->delete();

        $rsrvActivities = DB::connection($this->db_conn)->table('reservation_activities')
            ->join('park_activities', 'park_activities.id', '=', 'reservation_activities.park_activity_id')
            ->join('activities', 'activities.id', '=', 'park_activities.activity_id')
            ->join('parks', 'parks.id', '=', 'park_activities.park_id')
            ->join('visitor_types', 'visitor_types.id', '=', 'park_activities.type_id')
            ->leftJoin('activity_categories', 'activity_categories.id', '=', 'park_activities.category_id')
            ->where('reservation_activities.reservation_id', $request->reservation_id)
            ->select('reservation_activities.*', 'park_activities.activity_id', 'park_activities.category_id', 'park_activities.type_id', 'park_activities.park_id', 'visitor_types.type', 'activities.activity', 'activity_categories.category', 'parks.park_name')
            ->paginate($this->items);
        $data['rsrv_activities'] = view('reservations.activity-table', compact('rsrvActivities'))->render();

        $dayParks = DB::connection($this->db_conn)->table('reservation_activities')
            ->join('park_activities', 'park_activities.id', '=', 'reservation_activities.park_activity_id')
            ->join('parks', 'park_activities.park_id', '=', 'parks.id')
            ->where('reservation_activities.reservation_id', $request->reservation_id)
            ->select(DB::raw('DISTINCT reservation_activities.day, park_activities.park_id'), 'parks.park_name')
            ->get();
        $data['day_park_links'] = view('reservations.day-park', compact('dayParks'))->render();

        return response()->json($data);
    }
}
