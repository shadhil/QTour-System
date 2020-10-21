<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Intervention\Image\Facades\Image as Image;

class UserController extends Controller
{
    private $items;

    public function __construct()
    {
        $this->items = 20;
    }

    public function signIn(LoginRequest $request)
    {
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            throw new Exception('Wrong email or password.');
        }
    }

    public function signingView()
    {
        return view('login.main');
    }

    public function signOut()
    {
        Auth::logout();
        return redirect('/sign-in');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function load_users()
    {
        $items = 10;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newUser(Request $request)
    {
        //echo "<pre>";
        //echo $request->first_name;
        //die;
        // first_name: first_name,
        //     last_name: last_name,
        //     location: user_location,
        //     gender: gender,
        //     phone: phone,
        //     email: email,
        //     passowrd: passowrd,
        //     roles: roles,
        //     permissions: permissions,

        $validator = FacadesValidator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'user_photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required',
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
                    $originalPath = 'dist/images/abc';
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

            if ($request->roles != $request->og_roles) {
                $user->roles()->detach();
                $user->roles()->attach($request->roles);
            }

            if ($request->permissions != $request->og_permissions) {
                $user->permissions()->detach();
                $user->permissions()->attach($request->permissions);
            }

            $users = User::with('permissions')->with('roles')->withCount('reservations')->orderBy('id', 'desc')->paginate($request->count);
            $updatedView = view('users.users-table', compact('users'))->render();

            // return response
            $response = [
                'success' => true,
                'message' => 'User Added successfully.',
                'updatedUsers' => $updatedView
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
