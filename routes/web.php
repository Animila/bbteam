<?php

use App\Models\Chapter;
use App\Models\Scans;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/***
 *
 * ПРОЧЕЕ
 *
 ***/
Route::get('/', function () { return view('welcome');})->name('main');

/***
 *
 * РЕГИСТРАЦИЯ И АВТОРИЗАЦИЯ
 *
 ***/
Route::get('/register', function () {return view('account.register');})->name('register')->middleware('guest');
Route::post('/register', Account\RegisterController::class)->name('reg')->middleware('guest');

Route::get('/login', function () {return view('account.login');})->name('login')->middleware('guest');
Route::post('/auth', Account\LoginController::class)->name('auth')->middleware('guest');

Route::get('/logout', function (){Auth::logout();return back();})->name('logout')->middleware('auth');

/***
 *
 * ПРИВЯЗКА К СОЦИАЛЬНЫМ СЕТЯМ
 *
 ***/
Route::get('/social-auth/{provider}', function ($provider) {return Socialite::driver($provider)->scopes(['groups'])->redirect();})->name('auth.social');
Route::get('/social-auth/{provider}/callback', Account\SocialController::class)->name('auth.social.callback');
Route::get('/social/delete', function (){Account\SocialAccount::where('user_id', auth()->id())->first()->delete();return back();})->name('auth.delete');

/***
 *
 * ПРЕМИУМ
 *
 ***/
Route::get('/premium/VkDonut', Account\VkDonut::class)->name('premium.DONUT');
Route::get('/premium/VkDonut/unpin', function (){\auth()->user()->update(['premium'=>0]);return back();})->name('premium.UNDONUT');

/***
 *
 * АДМИН ПАНЕЛЬ
 *
 ***/
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::prefix('/statistics')->group(function () {
        Route::get('/', Admin\StatisticsController::class)->name('statistics');
    });

    Route::prefix('/titles')->group(function () {
        Route::get('/', Admin\Titles\TitlesController::class)->name('titles');
        Route::get('/create', Admin\Titles\CreateController::class)->name('titles.create');
        Route::post('/', Admin\Titles\StoreController::class)->name('titles.store');
        Route::get('/{manga}/edit', Admin\Titles\EditController::class)->name('titles.edit');
        Route::patch('/', Admin\Titles\UpdateController::class)->name('titles.update');
        Route::delete('/{manga}', Admin\Titles\DeleteController::class)->name('titles.delete');
    });

    Route::prefix('/chapters')->group(function () {
        Route::get('/', Admin\Chapters\ChaptersController::class)->name('chapter');
        Route::get('/create', Admin\Chapters\CreateController::class)->name('chapter.create');
        Route::post('/', Admin\Chapters\StoreController::class)->name('chapter.store');
        Route::get('/{chapter}/edit', Admin\Chapters\EditController::class)->name('chapter.edit');
        Route::patch('/', Admin\Chapters\UpdateController::class)->name('chapter.update');
        Route::delete('/{chapter}',Admin\Chapters\DeleteController::class)->name('chapter.delete');
    });

    Route::prefix('/scan')->group(function () {
        Route::post('/create', Admin\Chapters\Image\StoreController::class)->name('image.store');
        Route::patch('/{scan}', Admin\Chapters\Image\UpdateController::class)->name('image.update');
        Route::delete('/{scan}', Admin\Chapters\Image\DeleteController::class)->name('image.delete');
    });

});



