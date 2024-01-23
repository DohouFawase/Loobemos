<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * validation 
     */
    

public function validation(Request $request,User $user )//: RedirectResponse
{
    $validation = Validator::make($request->all(), [
        'naissance' => 'required|date',
        'contact' => 'required|unique:users,contact'. $user->id,
        'profession' => 'required',
        'photo' => 'image|mimes:jpeg,png,jpg,gif',
        'carte' => 'required|mimes:pdf,docx',
    ]);

    dd($validation);

    if ($validation->fails()) {
        return back()->withErrors($validation);
    }

    $users = Auth::user()->id;
    $user = User::findOrFail($users);

    $user->naissance = $request->naissance;
    $user->contact = $request->contact;
    $user->profession = $request->profession;
    $user->statut = 1;

    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $filename = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('Utilisateurs/Photos/'), $filename);
        $user->photo = $filename;
    }

    if ($request->hasFile('carte')) {
        $doc = $request->file('carte');
        $filename = time().'_'.$doc->getClientOriginalName();
        $doc->move(public_path('Utilisateurs/Documents/'), $filename);
        $user->carte = $filename;
    }
    
    $user->save();
    dd($user);

   return Redirect::to('/dashboard')->with('success', 'Votre sugestion a été envoyez avec sucess' );
}

}