<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $items = 6;

        $data['title'] = 'Blog';
        $data['keywords'] = 'Blog, AfyaTrack';
        $data['description'] = 'App Admins';


        $users = User::with('permissions')->with('roles')->paginate($this->items);
        $data['users'] = $users; //json_encode($users);

        //echo "<pre>";
        //print_r(json_decode(json_encode($data), true));
        //die;
        //dd($data);

        return view('users.users', compact('users'));
    }

    function filter_users(Request $request)
    {
        if ($request->post()) {
            $this->items = $request->count;
            $search = $request->search;

            $users = User::where('users.first_name', 'like', '%' . $search . '%')
                ->orWhere('users.first_name', 'like', '%' . $search . '%')
                ->with('permissions')->with('roles')
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
                ->with('permissions')->with('roles')
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
    public function create()
    {
        //
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
