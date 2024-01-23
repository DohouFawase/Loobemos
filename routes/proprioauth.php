<?php

use App\Http\Controllers\Proprio\ProprioAuthenticatedSessionController;
use App\Http\Controllers\Proprio\ConfirmablePasswordController;
use App\Http\Controllers\Proprio\EmailVerificationNotificationController;
use App\Http\Controllers\Proprio\EmailVerificationPromptController;
use App\Http\Controllers\Proprio\NewPasswordController;
use App\Http\Controllers\Proprio\PasswordController;
use App\Http\Controllers\Proprio\PasswordResetLinkController;
use App\Http\Controllers\Proprio\RegisteredUserController;
use App\Http\Controllers\Proprio\VerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:proprio')->group(function(){
    Route::get('proprio/register', [RegisteredUserController::class, 'create'])
                ->name('proprio.register');

    Route::post('proprio/register', [RegisteredUserController::class, 'store']);

    Route::get('proprio/login', [ProprioAuthenticatedSessionController::class, 'create'])
                ->name('proprio.login');

    Route::post('proprio/login', [ProprioAuthenticatedSessionController::class, 'store']);

    Route::get('proprio/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('proprio.password.request');

    Route::post('proprio/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('proprio.password.email');

    Route::get('proprio/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('proprio.password.reset');

    Route::post('proprio/reset-password', [NewPasswordController::class, 'store'])
                ->name('proprio.password.store');
});

Route::middleware('auth:proprio')->group(function(){
    Route::get('proprio/verify-email', EmailVerificationPromptController::class)
                ->name('proprio.verification.notice');

    Route::get('proprio/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('proprio.verification.verify');

    Route::post('proprio/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('proprio.verification.send');

    Route::get('proprio/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('proprio.password.confirm');

    Route::post('proprio/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('proprio/password', [PasswordController::class, 'update'])->name('proprio.password.update');

    Route::post('proprio/logout', [ProprioAuthenticatedSessionController::class, 'destroy'])
                ->name('proprio.logout');
});
