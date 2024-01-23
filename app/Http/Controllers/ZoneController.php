<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use Illuminate\Support\Facades\Validator;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::all();
        return inertia('Admin/addZone', [
          'zones' => $zones
      ]);
    }
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'zone' => 'required|unique:zones,zone'
      ]);
      $zones = new Zone();
      $zones->zone = $request->input('zone');
      $zones->save();

      return redirect()->back()->with('toast', 'nouvelle zone ajouté avec succès');
       
    }

    public function delete(Zone $zone)
    {
        $zone->delete();
        return redirect()->back()->with('toast', 'zone supprimé avec succès');
    }

}
