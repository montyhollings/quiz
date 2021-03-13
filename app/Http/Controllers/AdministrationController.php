<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdministrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administrator']);
    }

    public function index(Request $request)
    {
        $users = User::all();
        return view('administration.users.index', compact('users'));
    }

    public function edit(Request $request, User $user)
    {
        $type = 'edit';
        $roles = $user->getRoleNames();
        $formurl = route('admin.users.save', [$user]);
        return view('administration.users.addedit', compact('user', 'type', 'formurl', 'roles'));
    }

    public function save(UserEditRequest $request, User $user)
    {
        $user->update($request->input());
        if(strtolower($user->user_roles) != $request->input('role_select'))
        {
            $user->syncRoles([$request->input('role_select')]);
        }
        Session::flash('message', 'User Updated!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.users.index');
    }
}
