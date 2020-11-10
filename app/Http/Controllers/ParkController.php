<?php

namespace App\Http\Controllers;

use App\Models\Park;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ParkController extends Controller
{
    //private $items;
    private $db_conn;
    private $comp_db = "";
    private $app_db = "qtour_app_db";

    public function __construct()
    {
        //$this->items = 20;
        $this->db_conn = 'company_db';

        $this->app_db = config('database.connections.app_db.database');
        $this->comp_db = config('database.connections.company_db.database');
    }


    public function index()
    {
        $data['title'] = 'Parks';

        $data['regions'] = DB::table($this->app_db . '.tz_regions')->get();
        $data['parks'] = DB::table($this->comp_db . '.parks')
            ->join($this->app_db . '.tz_regions', $this->comp_db . '.parks.region_id', $this->app_db . '.tz_regions.id')
            ->select($this->comp_db . '.parks.*', $this->app_db . '.tz_regions.region')
            ->orderByDesc('parks.id')
            ->get();

        // echo "<pre>";
        // print_r(json_decode(json_encode($data), true));
        // die;
        //dd($data);

        return view('parks.main', compact('data'));
    }


    function filterParks(Request $request)
    {
        if ($request->post()) {
            $search = $request->search;


            $parks = DB::table($this->comp_db . '.parks')
                ->join($this->app_db . '.tz_regions', $this->comp_db . '.parks.region_id', $this->app_db . '.tz_regions.id')
                ->select($this->comp_db . '.parks.*', $this->app_db . '.tz_regions.region')
                ->where($this->comp_db . '.parks.park_name', 'like', '%' . $search . '%')
                ->orWhere($this->app_db . '.tz_regions.region', 'like', '%' . $search . '%')
                ->orderByDesc('parks.id')
                ->get();

            // echo "<pre>";
            // print_r(json_decode(json_encode($members), true));
            // die;
            //dd($data);

            //return compact('users');
            return view('parks.parks-table', compact('parks'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newPark(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'park_name' => 'required',
            'region' => 'required',
        ]);

        if (!$validator->fails()) {

            if ($request->og_park != $request->park_name) {
                if (Park::where('park_name', $request->park_name)->count() > 0) {
                    $response = [
                        'success' => false,
                        'message' => ["Park Already Added"],
                    ];
                    return response()->json($response, 200);
                }
            }

            $user = Park::updateOrCreate([
                'id' => $request->park_id
            ], [
                'park_name' => $request->park_name,
                'region_id' => $request->region,
            ]);

            $parks = DB::table($this->comp_db . '.parks')
                ->join($this->app_db . '.tz_regions', $this->comp_db . '.parks.region_id', $this->app_db . '.tz_regions.id')
                ->select($this->comp_db . '.parks.*', $this->app_db . '.tz_regions.region')
                ->orderByDesc('parks.id')
                ->get();

            $updatedView = view('parks.parks-table', compact('parks'))->render();
            // return response

            $response = [
                'success' => true,
                'message' => 'Park Added successfully.',
                'updatedParks' => $updatedView
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


    public function deletePark($parkId)
    {

        $data['deleted_park'] = DB::connection($this->db_conn)->table('parks')
            ->where('id', '=', $parkId)
            ->delete();

        $parks = DB::table($this->comp_db . '.parks')
            ->join($this->app_db . '.tz_regions', $this->comp_db . '.parks.region_id', $this->app_db . '.tz_regions.id')
            ->select($this->comp_db . '.parks.*', $this->app_db . '.tz_regions.region')
            ->orderByDesc('parks.id')
            ->get();

        $data['parks'] = view('parks.parks-table', compact('parks'))->render();

        return response()->json($data);
    }

    public function loadParkActivities($parkId)
    {
        $parkActivities = DB::connection($this->db_conn)->table('park_activities')
            ->join('activities', 'activities.id', 'park_activities.activity_id')
            ->leftJoin('activity_categories', 'activity_categories.id', 'park_activities.category_id')
            ->where('park_activities.park_id', $parkId)
            ->select('park_activities.*', 'activities.activity', 'activity_categories.category')
            ->get();

        $data['activities'] = view('parks.park-activities-list', compact('parkActivities'))->render();

        if (sizeof($parkActivities) > 0) {
            $data['success'] = true;
        } else {
            $data['success'] = false;
        }

        return response()->json($data);
    }


    public function loadAllActivities()
    {
        $activities = DB::connection($this->db_conn)->table('activities')->get();
        $categories = DB::connection($this->db_conn)->table('activity_categories')->get();

        if (sizeof($activities) > 0) {
            $response = [
                'success' => true,
                'message' => 'Activities Loaded Successfully.',
                'activities' => $activities,
                'categories' => $categories
            ];
            return response()->json(
                $response,
                200
            );
        }

        $response = [
            'success' => false,
            'message' => 'No Activity Found.',
            'activities' => [],
            'categories' => []
        ];
        return response()->json(
            $response,
            200
        );
    }


    public function addParkActivity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activity' => 'required',
            'category' => 'required',
            'ea_price_usd' => 'required',
            'ea_price_tzs' => 'required',
            'ex_price_usd' => 'required',
            'ex_price_tzs' => 'required',
            'nr_price_usd' => 'required',
            'nr_price_tzs' => 'required',
        ]);

        if (!$validator->fails()) {

            DB::connection($this->db_conn)->table('park_activities')->updateOrInsert(
                [
                    'id' => $request->ea_activity_id,
                    'park_id' => $request->activity_park_id,
                    'category_id' => $request->category,
                ],
                [
                    'activity_id' => $request->activity,
                    'type_id' => '1',
                    'price_tzs' => $request->ea_price_tzs,
                    'price_usd' => $request->ea_price_usd
                ]
            );

            DB::connection($this->db_conn)->table('park_activities')->updateOrInsert(
                [
                    'id' => $request->ex_activity_id,
                    'park_id' => $request->activity_park_id,
                    'category_id' => $request->category,
                ],
                [
                    'activity_id' => $request->activity,
                    'type_id' => '2',
                    'price_tzs' => $request->ex_price_tzs,
                    'price_usd' => $request->ex_price_usd
                ]
            );


            DB::connection($this->db_conn)->table('park_activities')->updateOrInsert(
                [
                    'id' => $request->nr_activity_id,
                    'park_id' => $request->activity_park_id,
                    'category_id' => $request->category,
                ],
                [
                    'activity_id' => $request->activity,
                    'type_id' => '3',
                    'price_tzs' => $request->nr_price_tzs,
                    'price_usd' => $request->nr_price_usd
                ]
            );

            $parkActivities = DB::connection($this->db_conn)->table('park_activities')
                ->join('activities', 'activities.id', 'park_activities.activity_id')
                ->leftJoin('activity_categories', 'activity_categories.id', 'park_activities.category_id')
                ->where('park_activities.park_id', $request->activity_park_id)
                ->select('park_activities.*', 'activities.activity', 'activity_categories.category')
                ->get();

            $updatedView1 = view('parks.park-activities-list', compact('parkActivities'))->render();

            // return response
            $response = [
                'success' => true,
                'message' => 'Activities Added successfully.',
                'updatedActivities' => $updatedView1,
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

    public function editParkActivity(Request $request)
    {
        $data['activities'] = DB::connection($this->db_conn)->table('park_activities')
            ->where([
                ['park_id', '=', $request->park_id],
                ['category_id', '=', $request->category_id]
            ])
            ->get();


        if (sizeof($data['activities']) > 0) {
            $data['success'] = true;
        } else {
            $data['success'] = false;
        }

        return response()->json($data);
    }


    public function deleteParkActivity(Request $request)
    {
        $data['deleted_activities'] = DB::connection($this->db_conn)->table('park_activities')
            ->where([
                ['park_id', '=', $request->park_id],
                ['category_id', '=', $request->category_id]
            ])
            ->delete();


        $parkActivities = DB::connection($this->db_conn)->table('park_activities')
            ->join('activities', 'activities.id', 'park_activities.activity_id')
            ->leftJoin('activity_categories', 'activity_categories.id', 'park_activities.category_id')
            ->where('park_activities.park_id', $request->activity_park_id)
            ->select('park_activities.*', 'activities.activity', 'activity_categories.category')
            ->get();

        $data['activities'] = view('parks.park-activities-list', compact('parkActivities'))->render();

        return response()->json($data);
    }
}
