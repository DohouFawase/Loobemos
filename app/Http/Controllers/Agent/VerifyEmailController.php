<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->agent()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::AGENT_HOME.'?verified=1');
        }

        if ($request->agent()->markEmailAsVerified()) {
            event(new Verified($request->agent()));
        }

        return redirect()->intended(RouteServiceProvider::AGENT_HOME.'?verified=1');
    }
}
