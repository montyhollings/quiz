<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        return view('administration.users.index', compact('users'));
    }
}
