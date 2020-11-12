<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;

class HotelController extends Controller
{
    private $items;
    private $db_conn = 'company_db';

    public function __construct()
    {
        $this->items = 20;
        $this->db_conn = 'company_db';
    }


    public function index()
    {
        $data['title'] = 'Hotels';

        $app_db = config('database.connections.app_db.database');
        $comp_db = config('database.connections.company_db.database');

        $data['regions'] = DB::table($app_db . '.tz_regions')->get();
        $data['parks'] = DB::connection('company_db')->table('parks')->get();

        $data['hotels'] = DB::connection('company_db')->table('hotels')
            ->select('id', 'name', 'photo')
            ->orderByDesc('id')
            ->paginate($this->items);

        // echo "<pre>";
        // print_r(json_decode(json_encode($data), true));
        // die;
        //dd($data);

        return view('hotels.main', compact('data'));
    }


    function filterHotels(Request $request)
    {
        if ($request->post()) {
            $this->items = $request->count;
            $search = $request->search;

            $hotels = DB::connection('company_db')->table('hotels')
                ->select('id', 'name', 'photo')
                ->where('name', 'like', '%' . $search . '%')
                ->orderByDesc('id')
                ->paginate($this->items);


            // echo "<pre>";
            // print_r(json_decode(json_encode($members), true));
            // die;
            //dd($data);

            //return compact('users');
            return view('hotels.hotels-table', compact('members'))->render();
        }
    }


    function navigateHotels(Request $request)
    {
        if ($request->post()) {
            $this->items = $request->count;
            $skip = (int)$this->items * $request->page;
            $search = $request->search;

            $hotels = DB::connection('company_db')->table('hotels')
                ->select('id', 'name', 'photo')
                ->where('name', 'like', '%' . $search . '%')
                ->orderByDesc('id')
                ->skip($skip)
                ->take($this->items)
                ->paginate($this->items);

            return view('hotels.hotels-table', compact('members'))->render();
        }
    }


    public function newHotel()
    {
        $data['title'] = 'New';
        $data['breadcrumbs'] = [
            ['url' => '/hotels', 'title' => 'Hotels']
        ];

        $app_db = config('database.connections.app_db.database');
        $comp_db = config('database.connections.company_db.database');

        $data['regions'] = DB::table($app_db . '.tz_regions')->get();
        $data['parks'] = DB::connection('company_db')->table('parks')->get();

        $data['hotel'] = [];

        $data['room_types'] = [];
        $data['room_categories'] = [];

        return view('hotels.add-hotel', compact('data'));
    }


    public function saveHotel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'location' => 'required',
            'region' => 'required',
            'email' => 'required',
        ]);

        if (!$validator->fails()) {

            if (!empty($request->email) && $request->og_email != $request->email) {
                if (Hotel::where('email', $request->email)->count() > 0) {
                    $response = [
                        'success' => false,
                        'message' => ["Email Already Exist"],
                    ];
                    return response()->json($response, 200);
                }
            }


            if (!empty($request->phones) && $request->og_phones != $request->phones) {
                if (Hotel::where('phones', $request->phones)->count() > 0) {
                    $response = [
                        'success' => false,
                        'message' => ["Phone Number Already Exist"],
                    ];
                    return response()->json($response, 200);
                }
            }

            if ($request->hasFile('hotel_photo')) {
                $files = $request->file('hotel_photo');
                if ($files->isValid()) {

                    $photoName = 'HTL_' . time() . '.' . $files->getClientOriginalExtension();
                    // for save original image
                    $ImageUpload = Image::make($files);
                    $originalPath = 'dist/images/abc/';
                    $ImageUpload->save($originalPath . $photoName);
                    $photoName = '/' . $originalPath . $photoName;
                }
            } else {
                if (empty($request->input('og_photo_name'))) {
                    $photoName = NULL;
                } else {
                    $photoName = $request->og_photo_name;
                }
            }

            if ($request->hasFile('rate_doc')) {
                $file = $request->file('rate_doc');
                if ($file->isValid()) {
                    // $fileName = 'RATE_' . time() . '.' . $request->rate_doc->getClientOriginalExtension();
                    // $filePath = $request->file('rate_doc')->storeAs('dist/files/rate_docs', $fileName, 'public');
                    // $rateDocument = $filePath;

                    $fileName = 'RATE_' . time() . '.' . $request->rate_doc->getClientOriginalExtension();
                    $request->rate_doc->move('dist/files/rate_docs/', $fileName);
                    $rateDocument = '/dist/files/rate_docs/' . $fileName;
                } else {
                    $rateDocument = NULL;
                }
            } else {
                if (empty($request->input('og_rate_doc'))) {
                    $rateDocument = NULL;
                } else {
                    $rateDocument = $request->og_rate_doc;
                }
            }

            $hotel = Hotel::updateOrCreate([
                'id' => $request->hotel_id
            ], [
                'name' => $request->name,
                'photo' => $photoName,
                'inside_park_id' => $request->inside_park,
                'near_park_id' => $request->near_park,
                'region_id' => $request->region,
                'email' => $request->email,
                'phones' => $request->phones,
                'location' => $request->location,
                'rate_doc' => $rateDocument,
            ]);


            // $hotels = DB::connection('company_db')->table('hotels')
            //     ->select('id', 'name', 'photo')
            //     ->orderByDesc('id')
            //     ->paginate($this->items);

            // $updatedView = view('hotels.hotels-table', compact('hotels'))->render();

            $response = [
                'success' => true,
                'message' => 'Hotel Added successfully.',
                'hotel_id' => $hotel['id']
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


    public function editHotel($hotelId)
    {
        $data['title'] = 'Edit Hotel';
        $data['breadcrumbs'] = [
            ['url' => '/hotels', 'title' => 'Hotels'],
            ['url' => '/hotels' . '/' . $hotelId . '/profile', 'title' => 'Hotel Profile']
        ];

        $app_db = config('database.connections.app_db.database');
        $comp_db = config('database.connections.company_db.database');

        $data['regions'] = DB::table($app_db . '.tz_regions')->get();
        $data['parks'] = DB::connection($this->db_conn)->table('parks')->get();

        $data['room_types'] = DB::connection($this->db_conn)->table('room_types')
            ->where('hotel_id', $hotelId)
            ->get();

        $data['room_categories'] = DB::connection($this->db_conn)->table('room_categories')
            ->where('hotel_id', $hotelId)
            ->get();

        $data['hotel'] = DB::table($comp_db . '.hotels')
            ->join($app_db . '.tz_regions', $app_db . '.tz_regions.id', $comp_db . '.hotels.region_id')
            ->where($comp_db . '.hotels.id', $hotelId)
            ->select($comp_db . '.hotels.*', $app_db . '.tz_regions.region')
            ->first();

        return view('hotels.add-hotel', compact('data'));
    }


    public function hotelProfile($hotelId)
    {
        $data['title'] = 'Hotel Profile';
        $data['breadcrumbs'] = [
            ['url' => '/hotels', 'title' => 'Hotels']
        ];

        $app_db = config('database.connections.app_db.database');
        $comp_db = config('database.connections.company_db.database');

        $data['regions'] = DB::table($app_db . '.tz_regions')->get();
        $data['parks'] = DB::connection($this->db_conn)->table('parks')->get();

        $data['room_types'] = DB::connection($this->db_conn)->table('room_types')
            ->where('hotel_id', $hotelId)
            ->get();

        $data['meal_plans'] = DB::connection($this->db_conn)->table('hotel_meal_plans')
            ->get();

        $data['room_categories'] = DB::connection($this->db_conn)->table('room_categories')
            ->where('hotel_id', $hotelId)
            ->get();

        $data['hotel'] = DB::table($comp_db . '.hotels')
            ->join($app_db . '.tz_regions', $app_db . '.tz_regions.id', $comp_db . '.hotels.region_id')
            ->where($comp_db . '.hotels.id', $hotelId)
            ->select($comp_db . '.hotels.*', $app_db . '.tz_regions.region')
            ->first();

        $data['hotel_rates'] = DB::connection($this->db_conn)->table('hotel_rates')
            ->join('room_categories', 'room_categories.id', 'hotel_rates.room_category_id')
            ->join('room_types', 'room_types.id', 'hotel_rates.room_type_id')
            ->join('hotel_meal_plans', 'hotel_meal_plans.id', 'hotel_rates.meal_plan_id')
            ->leftJoin('hotel_seasons', 'hotel_seasons.id', 'hotel_rates.season_id')
            ->where('hotel_rates.hotel_id', $hotelId)
            ->select('hotel_rates.*', 'room_types.room_type', 'room_categories.room_category', 'hotel_meal_plans.meal_plan', 'hotel_seasons.season')
            ->get();

        // echo "<pre>";
        // print_r(json_decode(json_encode($data), true));
        // die;
        //dd($data);

        return view('hotels.hotel-profile', compact('data'));
    }

    public function saveHotelType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);

        if (!$validator->fails()) {

            DB::connection($this->db_conn)->table('room_types')->updateOrInsert(
                [
                    'id' => $request->type_id
                ],
                [
                    'room_type' => $request->type,
                    'hotel_id' => $request->hotel_id
                ]
            );

            $roomTypes = DB::connection('company_db')->table('room_types')
                ->where('hotel_id', $request->hotel_id)
                ->get();

            $updatedView = view('hotels.room-type', compact('roomTypes'))->render();

            $response = [
                'success' => true,
                'message' => 'Type Added successfully.',
                'types' => $updatedView
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


    public function saveHotelCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
        ]);

        if (!$validator->fails()) {

            DB::connection($this->db_conn)->table('room_categories')->updateOrInsert(
                [
                    'id' => $request->category_id
                ],
                [
                    'room_category' => $request->category,
                    'hotel_id' => $request->hotel_id
                ]
            );


            $roomCategories = DB::connection('company_db')->table('room_categories')
                ->where('hotel_id', $request->hotel_id)
                ->get();

            $updatedView = view('hotels.room-category', compact('roomCategories'))->render();

            $response = [
                'success' => true,
                'message' => 'Type Added successfully.',
                'categories' => $updatedView
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


    public function saveHotelRates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meal_plan' => 'required',
            'category' => 'required',
            'room_type' => 'required',
            'hs_sto_rate' => 'required',
            'ls_sto_rate' => 'required',
        ]);

        if (!$validator->fails()) {

            DB::connection($this->db_conn)->table('hotel_rates')->updateOrInsert(
                [
                    'id' => $request->hs_rate_id,
                    'hotel_id' => $request->hotel_id,
                    'room_category_id' => $request->category,
                    'room_type_id' => $request->room_type,
                    'meal_plan_id' => $request->meal_plan
                ],
                [
                    'season_id' => '1',
                    'sto_rate' => $request->hs_sto_rate,
                    'rack_rate' => $request->hs_rack_rate
                ]
            );

            DB::connection($this->db_conn)->table('hotel_rates')->updateOrInsert(
                [
                    'id' => $request->ms_rate_id,
                    'hotel_id' => $request->hotel_id,
                    'room_category_id' => $request->category,
                    'room_type_id' => $request->room_type,
                    'meal_plan_id' => $request->meal_plan
                ],
                [
                    'season_id' => '2',
                    'sto_rate' => $request->ms_sto_rate,
                    'rack_rate' => $request->ms_rack_rate
                ]
            );


            DB::connection($this->db_conn)->table('hotel_rates')->updateOrInsert(
                [
                    'id' => $request->ls_rate_id,
                    'hotel_id' => $request->hotel_id,
                    'room_category_id' => $request->category,
                    'room_type_id' => $request->room_type,
                    'meal_plan_id' => $request->meal_plan
                ],
                [
                    'season_id' => '3',
                    'sto_rate' => $request->ls_sto_rate,
                    'rack_rate' => $request->ls_rack_rate
                ]
            );

            $hotelRates = DB::connection($this->db_conn)->table('hotel_rates')
                ->join('room_categories', 'room_categories.id', 'hotel_rates.room_category_id')
                ->join('room_types', 'room_types.id', 'hotel_rates.room_type_id')
                ->join('hotel_meal_plans', 'hotel_meal_plans.id', 'hotel_rates.meal_plan_id')
                ->leftJoin('hotel_seasons', 'hotel_seasons.id', 'hotel_rates.season_id')
                ->where('hotel_rates.hotel_id', $request->hotel_id)
                ->select('hotel_rates.*', 'room_types.room_type', 'room_categories.room_category', 'hotel_meal_plans.meal_plan', 'hotel_seasons.season')
                ->get();

            $updatedView1 = view('hotels.room-rates-table', compact('hotelRates'))->render();

            // return response
            $response = [
                'success' => true,
                'message' => 'Rates Added successfully.',
                'updatedRates' => $updatedView1,
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

    public function deleteHotelRates(Request $request)
    {
        $data['deleted_rates'] = DB::connection($this->db_conn)->table('hotel_rates')
            ->where([
                ['hotel_id', '=', $request->hotel_id],
                ['room_category_id', '=', $request->category_id],
                ['room_type_id', '=', $request->type_id],
                ['meal_plan_id', '=', $request->meal_id]
            ])
            ->delete();


        $hotelRates = DB::connection($this->db_conn)->table('hotel_rates')
            ->join('room_categories', 'room_categories.id', 'hotel_rates.room_category_id')
            ->join('room_types', 'room_types.id', 'hotel_rates.room_type_id')
            ->join('hotel_meal_plans', 'hotel_meal_plans.id', 'hotel_rates.meal_plan_id')
            ->leftJoin('hotel_seasons', 'hotel_seasons.id', 'hotel_rates.season_id')
            ->where('hotel_rates.hotel_id', $request->hotel_id)
            ->select('hotel_rates.*', 'room_types.room_type', 'room_categories.room_category', 'hotel_meal_plans.meal_plan', 'hotel_seasons.season')
            ->get();

        $data['updated_rates'] = view('hotels.room-rates-table', compact('hotelRates'))->render();

        return response()->json($data);
    }
}
