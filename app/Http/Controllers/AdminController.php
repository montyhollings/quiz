<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreationRequest;
use App\Http\Requests\UserDeleteRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Role;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function index()
    {
        $users = User::with('Role')->get();
        return view('administration.users.index', compact('users'));

    }

    public function new_user(Request $request)
    {
        $formurl = route('admin.users.submit_new_user');
        $roles = Role::all();
        $type = "add";
        return view('administration.users.addedit', compact('type', 'roles', 'formurl'));
    }

    public function submit_new_user(UserCreationRequest $request)
    {
        User::create($request->input());
        Session::flash('message', 'User Created!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.users.index');


    }

    public function edit(Request $request, User $user)
    {
        $type = "edit";
        $roles = Role::all();
        $formurl = route('admin.users.save', $user);
        return view('administration.users.addedit', compact('user', 'type', 'roles', 'formurl'));
    }

    public function save(Request $request, User $user)
    {
        $user->update($request->input());
        Session::flash('message', 'User Updated!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.users.index');
    }

    public function delete_modal(Request $request, User $user)
    {
        $formurl = route('admin.users.submit_delete', [$user]);
        $type = "user";
        return view('includes.delete_modal', compact('user', 'type', 'formurl'))->render();
    }

    public function submit_delete(Request $request, User $user)
    {
        if($user->id == Auth::user()->id){
            Session::flash('message', 'You cannot delete yourself!');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('admin.users.index');
        }
        if (Hash::check($request->input('password'), Auth::user()->password)) {
            $user->delete();
            Session::flash('message', 'User Deleted!');
            Session::flash('alert-class', 'alert-success');
            return response()->json(['url'=>route('admin.users.index')]);

        }
        return response()->json(array(
            'success' => false,
            'message' => 'Your password was incorrect, please try again.',

        ), 422);

        
    }
}
