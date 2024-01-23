<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
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
        return Inertia::render('Agent/Auth/Register');
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
            'email' => 'required|string|email|max:255|unique:'.Agent::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $id_agents = time().uniqid();


        $user = Agent::create([
            'id_agents' => $id_agents,
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

        Auth::guard('agent')->login($user);

        return redirect(RouteServiceProvider::AGENT_HOME);
    }
}
