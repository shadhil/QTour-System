<?php

namespace App\Http\Controllers;

use App\Models\CrewMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CrewJobTitle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;

class CrewController extends Controller
{
    private $items;
    private $db_conn;

    public function __construct()
    {
        $this->items = 10;
        $this->db_conn = 'company_db';
    }


    public function index()
    {
        $data['title'] = 'Drivers & Crew';

        $data['job_titles'] = CrewJobTitle::all();
        $data['members'] = DB::connection($this->db_conn)->table('crew_members')
            ->join('crew_job_titles', 'crew_members.job_title_id', 'crew_job_titles.id')
            ->leftJoin('crew_on_reservations', function ($join) {
                $join->on('crew_members.id', '=', 'crew_on_reservations.member_id')
                    ->whereDate('crew_on_reservations.start_date', '<=', date('Y-m-d'))
                    ->whereDate('crew_on_reservations.end_date', '>=', date('Y-m-d'));
            })
            ->select('crew_members.*', 'crew_job_titles.job_title', 'crew_on_reservations.reservation_id')
            ->groupBy('crew_members.id')
            ->orderByDesc('crew_members.id')
            ->paginate($this->items);

        // echo "<pre>";
        // print_r(json_decode(json_encode($data), true));
        // die;
        //dd($data);

        return view('drivers_crew.main', compact('data'));
    }


    function filter_users(Request $request)
    {
        if ($request->post()) {
            $this->items = $request->count;
            $search = $request->search;


            $members = DB::connection($this->db_conn)->table('crew_members')
                ->join('crew_job_titles', 'crew_members.job_title_id', 'crew_job_titles.id')
                ->leftJoin('crew_on_reservations', function ($join) {
                    $join->on('crew_members.id', '=', 'crew_on_reservations.member_id')
                        ->whereDate('crew_on_reservations.start_date', '<=', date('Y-m-d'))
                        ->whereDate('crew_on_reservations.end_date', '>=', date('Y-m-d'));
                })
                ->select('crew_members.*', 'crew_job_titles.job_title', 'crew_on_reservations.reservation_id')
                ->where('crew_members.first_name', 'like', '%' . $search . '%')
                ->orWhere('crew_members.first_name', 'like', '%' . $search . '%')
                ->orWhere('crew_job_titles.job_title', 'like', '%' . $search . '%')
                ->groupBy('crew_members.id')
                ->orderByDesc('crew_members.id')
                ->paginate($this->items);

            // echo "<pre>";
            // print_r(json_decode(json_encode($members), true));
            // die;
            //dd($data);

            //return compact('users');
            return view('drivers_crew.members-table', compact('members'))->render();
        }
    }


    function navigate_users(Request $request)
    {
        if ($request->post()) {
            $this->items = $request->count;
            $skip = (int)$this->items * $request->page;
            $search = $request->search;

            $members = DB::connection($this->db_conn)->table('crew_members')
                ->join('crew_job_titles', 'crew_members.job_title_id', 'crew_job_titles.id')
                ->leftJoin('crew_on_reservations', function ($join) {
                    $join->on('crew_members.id', '=', 'crew_on_reservations.member_id')
                        ->whereDate('crew_on_reservations.start_date', '<=', date('Y-m-d'))
                        ->whereDate('crew_on_reservations.end_date', '>=', date('Y-m-d'));
                })
                ->select('crew_members.*', 'crew_job_titles.job_title', 'crew_on_reservations.reservation_id')
                ->where('crew_members.first_name', 'like', '%' . $search . '%')
                ->orWhere('crew_members.first_name', 'like', '%' . $search . '%')
                ->orWhere('crew_job_titles.job_title', 'like', '%' . $search . '%')
                ->groupBy('crew_members.id')
                ->orderByDesc('crew_members.id')
                ->skip($skip)
                ->take($this->items)
                ->paginate($this->items);

            return view('drivers_crew.members-table', compact('members'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'job_title' => 'required',
            'phone_number' => 'required',
            'member_photo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (!$validator->fails()) {

            if (!empty($request->email) && $request->og_email != $request->email) {
                if (CrewMember::where('email', $request->email)->count() > 0) {
                    $response = [
                        'success' => false,
                        'message' => ["Email Already Exist"],
                    ];
                    return response()->json($response, 200);
                }
            }


            if (!empty($request->phone_number) && $request->og_phone != $request->phone_number) {
                if (CrewMember::where('phone_number', $request->phone_number)->count() > 0) {
                    $response = [
                        'success' => false,
                        'message' => ["Phone Number Already Exist"],
                    ];
                    return response()->json($response, 200);
                }
            }

            if ($request->hasFile('member_photo')) {
                $files = $request->file('member_photo');
                if ($files->isValid()) {

                    $photoName = 'USR_' . time() . '.' . $files->getClientOriginalExtension();
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

            $user = CrewMember::updateOrCreate([
                'id' => $request->member_id
            ], [
                'first_name' => $request->first_name,
                'photo' => $photoName,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'job_title_id' => $request->job_title,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'location' => $request->location,
                'company_id' => Auth::user()->company_id,
            ]);

            $members = DB::connection($this->db_conn)->table('crew_members')
                ->join('crew_job_titles', 'crew_members.job_title_id', 'crew_job_titles.id')
                ->leftJoin('crew_on_reservations', function ($join) {
                    $join->on('crew_members.id', '=', 'crew_on_reservations.member_id')
                        ->whereDate('crew_on_reservations.start_date', '<=', date('Y-m-d'))
                        ->whereDate('crew_on_reservations.end_date', '>=', date('Y-m-d'));
                })
                ->select('crew_members.*', 'crew_job_titles.job_title', 'crew_on_reservations.reservation_id')
                ->groupBy('crew_members.id')
                ->orderByDesc('crew_members.id')
                ->paginate($this->items);

            $updatedView = view('drivers_crew.members-table', compact('members'))->render();
            // return response

            $response = [
                'success' => true,
                'message' => 'Member Added successfully.',
                'updatedMembers' => $updatedView
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



    public function editMember($memberId)
    {
        $data['member'] = DB::connection($this->db_conn)->table('crew_members')
            ->join('crew_job_titles', 'crew_members.job_title_id', 'crew_job_titles.id')
            ->where('crew_members.id', $memberId)
            ->select('crew_members.*', 'crew_job_titles.job_title')
            ->first();

        return response()->json($data);

        //dd($data);
        // echo $data;
        // print_r(json_decode(json_encode($data), true));
        // die;
    }


    public function deleteMember($memberId)
    {
        $data['deleted_member'] = DB::connection($this->db_conn)->table('crew_members')
            ->where('id', $memberId)
            ->delete();


        $members = DB::connection($this->db_conn)->table('crew_members')
            ->join('crew_job_titles', 'crew_members.job_title_id', 'crew_job_titles.id')
            ->leftJoin('crew_on_reservations', function ($join) {
                $join->on('crew_members.id', '=', 'crew_on_reservations.member_id')
                    ->whereDate('crew_on_reservations.start_date', '<=', date('Y-m-d'))
                    ->whereDate('crew_on_reservations.end_date', '>=', date('Y-m-d'));
            })
            ->select('crew_members.*', 'crew_job_titles.job_title', 'crew_on_reservations.reservation_id')
            ->groupBy('crew_members.id')
            ->orderByDesc('crew_members.id')
            ->paginate($this->items);

        $data['members'] = view('drivers_crew.members-table', compact('members'))->render();

        return response()->json($data);
    }
}
