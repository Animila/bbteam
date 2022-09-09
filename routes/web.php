<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', function () {
    return 'главная';
})->name('main');

//авторизация и регистрация
Route::post('/register', Account\RegisterController::class)->name('reg')->middleware('guest');
Route::post('/auth', Account\LoginController::class)->name('auth')->middleware('guest');
Route::get('/logout', function (){Auth::logout();return back();})->name('logout')->middleware('auth');

//подключение социальных аккаунтов
Route::get('/social-auth/{provider}', function ($provider) {return Socialite::driver($provider)->scopes(['groups'])->redirect();})->name('auth.social');
Route::get('/social-auth/{provider}/callback', Account\SocialController::class)->name('auth.social.callback');
Route::get('/social/delete', function ()
{
    Account\SocialAccount::where('user_id', auth()->id())->first()->delete();
    return back();
}
)->name('auth.delete');

//подключение премиума
Route::get('/premium/VkDonut', Account\VkDonut::class)->name('premium.DONUT');
Route::get('/premium/VkDonut/unpin', function (){\auth()->user()->update(['premium'=>0]);return back();})->name('premium.UNDONUT');


Route::get('/admin', function ()
{
//    if (Gate::check('for_admin_user')){
//        return 'админ';
//    } else {
//        return 'нельзя';
//    }
    return view('admin.main.index');
})->name('admin');
//    ->middleware('auth');
//Route::get('/account', function () {return view('account.index');})->name('account.index')->middleware('auth');
//Route::get('/manga/{title_eng}/{chapter}', MangaShowScans::class)->name('manga.show.scans')->middleware('auth');

