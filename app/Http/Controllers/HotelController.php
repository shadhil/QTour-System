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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newHotel(Request $request)
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

            $user = Hotel::updateOrCreate([
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
            ]);


            $hotels = DB::connection('company_db')->table('hotels')
                ->select('id', 'name', 'photo')
                ->orderByDesc('id')
                ->paginate($this->items);

            $updatedView = view('hotels.hotels-table', compact('hotels'))->render();

            $response = [
                'success' => true,
                'message' => 'Hotel Added successfully.',
                'updatedHotels' => $updatedView
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


    public function hotelProfile($hotelId)
    {
        $data['title'] = 'Hotels';

        $app_db = config('database.connections.app_db.database');
        $comp_db = config('database.connections.company_db.database');

        $data['regions'] = DB::table($app_db . '.tz_regions')->get();
        $data['parks'] = DB::connection('company_db')->table('parks')->get();

        $data['hotels'] = DB::connection('company_db')->table('hotels')
            ->where('id', $hotelId)
            ->select('id', 'name', 'photo')
            ->orderByDesc('id')
            ->paginate($this->items);

        return view('hotels.hotel-profile', compact('data'));
    }
}
