<?php

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [SignatureController::class, 'home']);


Route::get('email/complete', [VerificationController::class, 'complete'])->name('verification.complete');
Route::post('email/verify/{token}', [VerificationController::class, 'verify'])->name('verification.verify');


Route::resource('users', UserController::class);
Route::post('users/{id}/disable', [UserController::class, 'disable'])->name('users.disable');
Route::post('users/{id}/enable', [UserController::class, 'enable'])->name('users.enable');
Route::resource('departments', DepartmentController::class);
Route::get('/signature', [SignatureController::class, 'index'])->name('signature.index');

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');




Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
});

Route::middleware('verified')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile.index');
});
