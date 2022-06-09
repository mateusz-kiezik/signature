<?php

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


Route::resource('users', UserController::class);
Route::resource('departments', DepartmentController::class);


Route::middleware('auth')->group(function () {
    Route::get('/signature', [SignatureController::class, 'index'])->name('signature.index');
    Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::prefix('data')->group(function () {
        Route::get('/users', [UserController::class, 'data'])->name('users.data');
    });
});


Auth::routes();
