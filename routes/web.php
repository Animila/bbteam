<?php

use App\Http\Controllers\Account\LoginController;
use App\Http\Controllers\Account\RegisterController;
use App\Http\Controllers\GetController;
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

Route::get('/', GetController::class)->name('main');

Route::get('/register', function (){return view('account.register');})->name('register')->middleware('guest');
Route::post('/reg', RegisterController::class)->name('reg')->middleware('guest');

Route::get('/login', function (){return view('account.login');})->name('login')->middleware('guest');
Route::post('/auth', LoginController::class)->name('auth')->middleware('guest');

Route::get('/logout', function ()
    {
        Auth::logout();
        return back();
    }
)->name('logout')->middleware('auth');

Route::get('/account', function () {return 'защищенный сектор';})->name('account.index')->middleware('auth');
//
//Route::get('/', \App\Http\Controllers\GetController::class);
//Route::get('/', \App\Http\Controllers\GetController::class);

