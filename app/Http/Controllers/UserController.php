<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Intervention\Image\Facades\Image as Image;

class UserController extends Controller
{

    private $items;
    private $db_conn;

    public function __construct()
    {
        $this->items = 10;
        $this->db_conn = 'app_db';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function load_users()
    {
        $data['title'] = 'Users';

        $data['roles'] = Role::all();
        $data['permissions'] = Permission::all();

        $users = User::with('permissions')->with('roles')->withCount('reservations')->orderBy('id', 'desc')->paginate($this->items);
        $data['users'] = $users; //json_encode($users);

        //echo "<pre>";
        //print_r(json_decode(json_encode($data), true));
        //die;
        //dd($data);

        return view('users.users', compact('data'));
    }

    function filter_users(Request $request)
    {
        if ($request->post()) {
            $this->items = $request->count;
            $search = $request->search;

            $users = User::where('users.first_name', 'like', '%' . $search . '%')
                ->orWhere('users.first_name', 'like', '%' . $search . '%')
                ->with('permissions')->with('roles')->withCount('reservations')
                ->paginate($this->items);

            // echo "<pre>";
            // print_r(json_decode(json_encode($users), true));
            // die;
            //dd($data);

            //return compact('users');
            return view('users.users-table', compact('users'))->render();
        }
    }


    function navigate_users(Request $request)
    {
        if ($request->post()) {
            $this->items = $request->count;
            $skip = (int)$this->items * $request->page;
            $search = $request->search;

            $users = User::where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->with('permissions')->with('roles')->withCount('reservations')
                ->skip($skip)
                ->take($this->items)
                ->paginate($this->items);

            return view('users.users-table', compact('users'))->render();
        }
    }

    function addUser(Request $request)
    {
        $og_permissions = [];
        $og_roles = [];
        if (User::find($request->user_id)->count() > 0) {
            $og_permissions = User::find($request->user_id)->permissions()->pluck('id')->toArray();
            $og_roles = User::find($request->user_id)->roles()->pluck('id')->toArray();
        }
        $validator = FacadesValidator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'user_photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'password' =>  $request->operation == 'edit' ? '' : 'required',
            'roles' => 'required'
        ]);

        if (!$validator->fails()) {

            if (User::where('email', $request->email)->count() > 0) {
                $response = [
                    'success' => false,
                    'message' => ["Email Already Exist"],
                ];
                return response()->json($response, 200);
            }

            if ($request->hasFile('user_photo')) {
                $files = $request->file('user_photo');
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

            $user = User::updateOrCreate([
                'id' => $request->user_id
            ], [
                'first_name' => $request->first_name,
                'photo' => $photoName,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => (empty($request->password) ? $request->ogp_data : Hash::make($request->password)),
                'location' => $request->location,
            ]);

            if ($request->roles != $og_roles) {
                $user->roles()->detach();
                $user->roles()->attach($request->roles);
            }

            if ($request->permissions != $og_permissions) {
                $user->permissions()->detach();
                $user->permissions()->attach($request->permissions);
            }

            // return response
            $response = [
                'success' => true,
                'message' => 'User Added successfully.'
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

    public function newUser()
    {
        $data['title'] = 'New User';
        $data['breadcrumbs'] = [
            ['url' => '/users', 'title' => 'Users']
        ];

        $data['roles'] = Role::all();
        $data['permissions'] = Permission::all();

        $data['user_permissions'] = [];
        $data['user_roles'] = [];
        $data['user'] = [];

        //echo "<pre>";
        //print_r(json_decode(json_encode($data), true));
        //die;
        //dd($data);

        return view('users.user-add', compact('data'));
    }



    public function editUser($userUrl)
    {
        $data['title'] = 'Edit User';
        $data['breadcrumbs'] = [
            ['url' => '/users', 'title' => 'Users']
        ];

        $user = User::with('permissions')->with('roles')->where('users.url_string', $userUrl)->first();
        $data['user'] = $user;

        $data['user_permissions'] = User::find($user['id'])->permissions()->pluck('id')->toArray();
        $data['permissions'] = Permission::all();

        $data['user_roles'] = User::find($user['id'])->roles()->pluck('id')->toArray();
        $data['roles'] = Role::all();

        //dd($data);
        // echo '<pre>';
        // print_r(json_decode(json_encode($data), true));
        // die;

        return view('users.user-add', compact('data'));
    }

    public function userProfile($userUrl)
    {
        $user = User::with('permissions')->with('roles')->where('users.url_string', $userUrl)->first();
        $data['user'] = $user;

        $data['user_permissions'] = User::find($user['id'])->permissions()->pluck('id')->toArray();

        $data['user_roles'] = User::find($user['id'])->roles()->pluck('id')->toArray();

        // echo '<pre>';
        // print_r(json_decode(json_encode($data), true));
        // die;

        return response()->json($data);
    }



    public function deleteUser($userId)
    {
        $data['deleted_member'] = DB::connection($this->db_conn)->table('users')
            ->where('id', $userId)
            ->delete();

        $users = User::with('permissions')->with('roles')->withCount('reservations')->orderBy('id', 'desc')->paginate($this->items);

        $data['users'] = view('users.users-table', compact('users'))->render();

        return response()->json($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
