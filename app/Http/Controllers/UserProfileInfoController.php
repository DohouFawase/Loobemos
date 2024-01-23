<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileInfoController extends Controller
{
    //
    public function index() 
    {
        $users = User::all();

        return inertia('Admin/User', [
            'users' => $users
        ]) ;

    }
}
