<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserController;

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


Route::prefix('/')->group(function () {
    Route::name('login.')->prefix('login')->middleware('guest:admin')->group(function () {
        Route::get('', [AuthenticatedSessionController::class, 'create'])->name('index');
        Route::post('', [AuthenticatedSessionController::class, 'store'])->name('store');
    });
    Route::middleware('auth:admin')->group(function () {
        Route::get('/', function () {
            $arr['flag'] = 'dashboard';
            return view('index', $arr);
        })->name('index');
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::resource('users', UserController::class);
    });
});
