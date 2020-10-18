<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::with('permissions')->with('roles')->paginate(4);
        $data['users'] = $users; //json_encode($users);
        return view('livewire.users', ['users' => $users]);
    }
}
