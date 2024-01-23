<?php

use App\Http\Controllers\Agent\AgentAuthenticatedSessionController;
use App\Http\Controllers\Agent\ConfirmablePasswordController;
use App\Http\Controllers\Agent\EmailVerificationNotificationController;
use App\Http\Controllers\Agent\EmailVerificationPromptController;
use App\Http\Controllers\Agent\NewPasswordController;
use App\Http\Controllers\Agent\PasswordController;
use App\Http\Controllers\Agent\PasswordResetLinkController;
use App\Http\Controllers\Agent\RegisteredUserController;
use App\Http\Controllers\Agent\VerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:agent')->group(function(){
    Route::get('agent/register', [RegisteredUserController::class, 'create'])
                ->name('agent.register');

    Route::post('agent/register', [RegisteredUserController::class, 'store']);

    Route::get('agent/login', [AgentAuthenticatedSessionController::class, 'create'])
                ->name('agent.login');

    Route::post('agent/login', [AgentAuthenticatedSessionController::class, 'store']);

    Route::get('agent/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('agent.password.request');

    Route::post('agent/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('agent.password.email');

    Route::get('agent/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('agent.password.reset');

    Route::post('agent/reset-password', [NewPasswordController::class, 'store'])
                ->name('agent.password.store');
});

Route::middleware('auth:agent')->group(function(){
    Route::get('agent/verify-email', EmailVerificationPromptController::class)
                ->name('agent.verification.notice');

    Route::get('agent/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('agent.verification.verify');

    Route::post('agent/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('agent.verification.send');

    Route::get('agent/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('agent.password.confirm');

    Route::post('agent/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('agent/password', [PasswordController::class, 'update'])->name('agent.password.update');

    Route::post('agent/logout', [AgentAuthenticatedSessionController::class, 'destroy'])
                ->name('agent.logout');
});
