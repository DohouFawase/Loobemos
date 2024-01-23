<?php

namespace App\Http\Controllers;

use App\Mail\ReservationMails;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Locations;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    
    public function index (){
        $reservations = Reservation::latest()->get();

        return inertia('Admin/Reservation', [
            'reservations' => $reservations
        ]) ;

    }
    

    public function store(Request $request){
        $request->validate([
            'telephone' => 'required',
            'date' => 'required',
            'heure' => 'required',
            'locationid' => 'required'
        ]);
       
        $location = $request->input('locationid');
        
        $user = Auth::user();
        $locations = Locations::with('images')
        ->where('locations_id',$location)
        ->firstOrFail();

        $reservation = Reservation::create([
        'id_locations' => $locations->locations_id,
        'id_users' => $user->id_users,
        'date' => $request->input('date'),
        'heure' => $request->input('heure'),
        'tel' => $request->input('telephone')
        ]);
        return to_route('')->with('message','Votre reservation a été envoyé avec succès');

     /*  $reservation = new Reservation();
      $reservation->id_locations = $locations->locations_id;
      $reservation->id_users = $user->id_users;
      $reservation->date = $request->input('date');
      $reservation->heure = $request->input('heure');
      $reservation->tel = $request->input('telephone');
      
      $reservation->save(); */


     // Mail::to('tesr')
      ///      ->cc('')
       //     ->bcc('')
         //   ->send(new ReservationMails());



         ReservationMails::sendNow($reservation);

        return to_route('');
         

    }
    public function show($location){

        $reservations = Reservation::with('locations')
        ->all();
  
        return inertia('Admin/Dashboard', [
          'reservations' => $reservations
      ]);


      }
}
