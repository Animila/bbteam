<?php

use App\Models\Scans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*** ПРОЧЕЕ ***/
Route::get('/', function () { return view('welcome');})->name('main');

/*** РЕГИСТРАЦИЯ И АВТОРИЗАЦИЯ ***/
Route::prefix('/account')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/register', function () {return view('account.register');})->name('register');
        Route::post('/register', Account\RegisterController::class)->name('reg');

        Route::get('/login', function () {return view('account.login');})->name('login');
        Route::post('/auth', Account\LoginController::class)->name('auth');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/logout', function (){Auth::logout();return back();})->name('logout');
    });

});

/*** ПРИВЯЗКА К СОЦИАЛЬНЫМ СЕТЯМ ***/
Route::prefix('/social-auth')->group(function () {
    Route::get('/{provider}', function ($provider) {return Socialite::driver($provider)->scopes(['groups'])->redirect();})->name('auth.social');
    Route::get('/{provider}/callback', Account\SocialController::class)->name('auth.social.callback');
    Route::get('/delete', function (){Account\SocialAccount::where('user_id', auth()->id())->first()->delete();return back();})->name('auth.delete');
});

/*** ПРЕМИУМ ***/
Route::prefix('/premium')->middleware('auth')->group(function () {
    Route::get('/VkDonut', Account\VkDonut::class)->name('premium.DONUT');
    Route::get('/VkDonut/unpin', function (){\auth()->user()->update(['premium'=>0]);return back();})->name('premium.UNDONUT');
});

/*** АДМИН ПАНЕЛЬ  ***/
Route::prefix('admin')->middleware('auth')->group(function () {

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

        Route::prefix('/scan')->group(function () {
            Route::post('/create', Admin\Chapters\Image\StoreController::class)->name('image.store');
            Route::patch('/{scan}', Admin\Chapters\Image\UpdateController::class)->name('image.update');
            Route::post('/add', Admin\Chapters\Image\AddController::class)->name('image.add');
            Route::delete('/{scan}', Admin\Chapters\Image\DeleteController::class)->name('image.delete');
        });
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', Admin\Users\UsersController::class)->name('users');
        Route::get('/ban/{user}', Admin\Users\BanController::class)->name('users.ban');
        Route::get('/unban/{user}', Admin\Users\UnBanController::class)->name('users.unban');
        Route::get('/edit/{user}', Admin\Users\EditController::class)->name('users.edit');
        Route::patch('/edit/{user}', Admin\Users\UpdateController::class)->name('users.update');
        Route::patch('/password/{user}', Admin\Users\UpdatePasswordController::class)->name('users.password.update');
    });

    Route::prefix('/tags')->group(function () {
        Route::get('/', Admin\Tags\TagsController::class)->name('tags');
        Route::get('/create', Admin\Tags\CreateController::class)->name('tags.create');
        Route::post('/', Admin\Tags\StoreController::class)->name('tags.store');
        Route::get('/{tag}', Admin\Tags\EditController::class)->name('tags.edit');
        Route::patch('/{tag} ', Admin\Tags\UpdateController::class)->name('tags.update');
        Route::delete('/{tag} ', Admin\Tags\DeleteController::class)->name('tags.delete');
    });

});



