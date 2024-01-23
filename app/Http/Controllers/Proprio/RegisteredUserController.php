<?php

namespace App\Http\Controllers\Proprio;

use App\Http\Controllers\Controller;
use App\Models\Proprio;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Proprio/Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.Proprio::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Proprio::create([
            'id_proprios' => time().uniqid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'naissance' => "",
            'contact' => "",
            'profession' => "",
            'photo' => "",
            'carte' => ""
        ]);

        event(new Registered($user));

        Auth::guard('proprio')->login($user);

        return redirect(RouteServiceProvider::PROPRIO_HOME);
    }
}
