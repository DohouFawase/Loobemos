<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;


class FrontReservationController extends Controller
{
    //
    public function index()  {
        $user = Auth::user();
        $reservations = Reservation::where('id_users',$user->id_users)->get();
        return inertia('Dashboard', [
            'reservations' => $reservations
        ]) ;
    }
}
