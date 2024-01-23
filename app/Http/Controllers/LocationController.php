<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locations;
use App\Models\Zone;
use App\Models\LocationImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class LocationController extends Controller

{

    public function index(Request $request)
    {
     // $locations = Locations::with('images')->get();
      $search = $request->search;
        $query = Locations::with('images')
            ->when($search, function ($query) use ($search)
            {
               $query->where('type', 'like', "%".$search."%");
            })
            ->paginate(30)
            ->all();
            
     
    return inertia('Home', [
      'locations' => $query,
      'filters' => $request->only(['search'])
  ]);
    }

    public function show($location){

      $locations = Locations::with('images')
      ->where('locations_id',$location)
      ->firstOrFail();

      $createdAt = Carbon::parse($locations->created_at);
      $now = Carbon::now();
      $durations = $createdAt->diffForHumans($now);
      $duration = strtr($durations,[
        'yesterday' => 'hier',
        'today' => 'aujourdh\'ui',
        'tomorrow' => 'demain',
        'this' => 'cette',
        'last' => 'dernière',
        'ago' => 'il y a',
        'before' => 'il y a',
        'year' => 'ans',
        'month' => 'mois',
        'week' => 'semaine',
        'day' => 'jour',
        'hour' => 'heures',
        'minute' => 'min',
        'second' => 's'
      ]);

     // $parts = explode(' ', $duration);
    //  $result = implode(' ', array_reverse($parts));

      return inertia('Locations/Show', [
        'locations' => $locations,
        'timestamp' => $duration
    ]);
    }


    public function store(Request $request){
      $validator = Validator::make($request->all(), [
        'type' => 'required',
        'pieces' => 'required',
        'cuisine' => 'required',
        'douches' => 'required',
        'wc' => 'required',
        'descriptionshort' => 'required',
        'pays' => 'required',
        'ville' => 'required',
        'zone' => 'required',
        'loyer' => 'required',
        'avances' => 'required',
        'prepayes' => 'required',
        'cautions' => 'required',
        'commission' => 'required',
        'descriptionlong' => 'required',
        'images' => 'required|array|min:1',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      $user = Auth::user();


      $location = new Locations();
      $location->locations_id = uniqid();
      $location->type = $request->input('type');
      $location->pieces = $request->input('pieces');
      $location->cuisine = $request->input('cuisine');
      $location->douches = $request->input('douches');
      $location->wc = $request->input('wc');
      $location->pays = $request->input('pays');
      $location->ville = $request->input('ville');
      $location->zone = $request->input('zone');
      $location->court_description = $request->input('descriptionshort');
      $location->loyer = $request->input('loyer');
      $location->avances = $request->input('avances');
      $location->prepayes = $request->input('prepayes');
      $location->cautions = $request->input('cautions');
      $location->commission = $request->input('commission');
      $location->longue_description = $request->input('descriptionlong');
      $location->auteur_name = $user->name;
      $location->auteur_type = 'admins'; 
      $location->auteur_id = $user->id;
       
      
      $location->save();

      if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
          $locationImage = new LocationImage();
          $filename = time() . '_' . $image->getClientOriginalName();
          $image->move(public_path('locations_images'), $filename);
          $locationImage->locations_id = $location->id;
          $locationImage->images = $filename;
          $locationImage->save();
        }
      }

      return redirect()->back()->with('toast', 'nouvelle Location ajouté avec succès');

    }

    public function edit($location){
      $locations = Locations::with('images')
      ->where('locations_id',$location)
      ->firstOrFail();

      $zones = Zone::all();

      return inertia('Admin/EditLocation', [
        'location' => $locations,
        'zones' => $zones
    ]);
    }
    public function update(Request $request){

    }
}

