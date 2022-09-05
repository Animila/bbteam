<?php

use App\Http\Controllers\Account\LoginController;
use App\Http\Controllers\Account\RegisterController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\GetController;
use App\Http\Controllers\MangaShowScans;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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


Route::get('/social-auth/{provider}', function ($provider) {return Socialite::driver($provider)->redirect();})->name('auth.social');
Route::get('/social-auth/{provider}/callback', SocialController::class)->name('auth.social.callback');
Route::get('/social/delete', function ()
{
    SocialAccount::where('user_id', auth()->id())->first()->delete();
    return back();
}
)->name('auth.delete');


Route::get('/account', function () {return 'защищенный сектор';})->name('account.index')->middleware('auth');
Route::get('/manga/{title_eng}/{chapter}', MangaShowScans::class)->name('manga.show.scans')->middleware('auth');
Route::get('/admin', function ()
{
    if (Gate::check('for_admin_user')){
        return 'админ';
    } else {
        return 'нельзя';
    }
}
)->name('admin')->middleware('auth');

