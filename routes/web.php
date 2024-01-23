<?php
use App\Models\Locations;
use App\Models\Zone;
use App\Models\Reservation;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Agent\AgentProfileController;
use App\Http\Controllers\FrontReservationController;
use App\Http\Controllers\Proprio\ProprioProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserProfileInfoController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//acceuil

Route::get('/', [LocationController::class, 'index'])->name('home');


//description de locations
Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.show');


   

//user

Route::get('/dashboard', function () {
    $user = Auth::user();
    $reservations = Reservation::where('id_users',$user->id_users)->get();
    return Inertia::render('Dashboard', [
        "reservations" =>  $reservations
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/validation', function () {
        return Inertia::render('CompleteProfil');
    })->name('validation.index');

    Route::post('/locations',[ReservationController::class, 'store'])->name('reservation.store');
    Route::post('/validation', [ProfileController::class, 'validation'])->name('validation.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



//agent
require __DIR__.'/agentauth.php';


Route::middleware('auth:agent')->group(function () {
    Route::get('/agent/dashboard', function () {
        return Inertia::render('Agent/Dashboard');
    })->name('agent.dashboard');

    Route::get('/agent/profile', [AgentProfileController::class, 'edit'])->name('agent.profile.edit');
    Route::patch('/agent/profile', [AgentProfileController::class, 'update'])->name('agent.profile.update');
    Route::delete('/agent/profile', [AgentProfileController::class, 'destroy'])->name('agent.profile.destroy');
});

//admin
require __DIR__.'/adminauth.php';


Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        $locationsTotal = Locations::count();
        $reservationTotal = Reservation::count();
        dd([$reservationTotal,$locationsTotal]);
        return Inertia::render('Admin/Dashboard', [
            'locations' => Locations::with('images')->get(),
            'reservations' =>Reservation::all(),
            'locationsTotal' => $locationsTotal,
            'reservationTotal' => $reservationTotal,
            ]);
    })->name('admin.dashboard');

    Route::get('/admin/reservations',[ReservationController::class, 'index'])->name('reservation.index');
    Route::get('/admin/user',[UserProfileInfoController::class, 'index'])->name('user.index');

    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

//proprio
require __DIR__.'/proprioauth.php';


Route::middleware('auth:proprio')->group(function () {
    Route::get('/proprio/dashboard', function () {
        return Inertia::render('Proprio/Dashboard');
    })->name('proprio.dashboard');

    Route::get('/proprio/profile', [ProprioProfileController::class, 'edit'])->name('proprio.profile.edit');
    Route::patch('/proprio/profile', [ProprioProfileController::class, 'update'])->name('proprio.profile.update');
    Route::delete('/proprio/profile', [ProprioProfileController::class, 'destroy'])->name('proprio.profile.destroy');
});





Route::middleware('auth:admin')->group(function () {
    Route::get('admin/newLocation', function () {
        $zones = Zone::all();
        return inertia('Admin/NewLocation', [
          'zones' => $zones
      ]);
    })->name('newLocation.index');
    
    Route::post('admin/newLocation', [LocationController::class, 'store'])->name('newLocation.store');
    Route::get('admin/locations/{location}/edit', [LocationController::class,'edit'])->name('locations.edit');
    Route::patch('admin/locations/{location}/update', [LocationController::class,'update'])->name('locations.update');

    Route::get('admin/addZone', [ZoneController::class, 'index'])->name('addZone.index');
    Route::post('admin/addZone', [ZoneController::class, 'store'])->name('addZone.store');
    Route::get('admin/addZone/{zone}/delete', [ZoneController::class, 'delete'])->name('addZone.delete');
    
});

