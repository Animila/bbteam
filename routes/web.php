<?php

use App\Models\Chapter;
use App\Models\Manga;
use App\Models\Scans;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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
Route::get('/register', function () {
    return view('account.register');
})->name('register')->middleware('guest');
Route::get('/login', function () {
    return view('account.login');
})->name('login')->middleware('guest');

Route::post('/register', Account\RegisterController::class)->name('reg')->middleware('guest');
Route::post('/auth', Account\LoginController::class)->name('auth')->middleware('guest');
Route::get('/logout', function (){Auth::logout();return back();})->name('logout')->middleware('auth');

/***
 *
 * ПРИВЯЗКА К СОЦИАЛЬНЫМ СЕТЯМ
 *
 ***/
Route::get('/social-auth/{provider}', function ($provider) {return Socialite::driver($provider)->scopes(['groups'])->redirect();})->name('auth.social');
Route::get('/social-auth/{provider}/callback', Account\SocialController::class)->name('auth.social.callback');
Route::get('/social/delete', function ()
{
    Account\SocialAccount::where('user_id', auth()->id())->first()->delete();
    return back();
})->name('auth.delete');

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
    Route::get('/statistics', Admin\StatisticsController::class)->name('statistics');

    Route::get('/titles', Admin\Titles\TitlesController::class)->name('titles');
    Route::get('/titles/{manga}/edit', function (Manga $manga) {
        $content = [
            'robots'=>'ALL, NOARCHIVE',
            'title_page'=>'Редактирование '.$manga->title_ru,
            'description'=>'Что-то',
            'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
            'manga'=>$manga
        ];

        return view('admin.titles.edit', compact('content'));
    })->name('titles.edit');
    Route::get('/titles/create', function () {
        $content = [
            'robots'=>'ALL, NOARCHIVE',
            'title_page'=>'Добавление нового тайтла',
            'description'=>'Что-то',
            'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
        ];

        return view('admin.titles.create', compact('content'));
    })->name('titles.create');
    Route::post('/titles', Admin\Titles\StoreController::class)->name('titles.store');
    Route::patch('/titles', Admin\Titles\UpdateController::class)->name('titles.update');
    Route::delete('/titles/{manga}', function (Manga $manga) {

        foreach ($manga->chapters as $chapter) {
            foreach ($chapter->scans as $scan) {
                unlink(public_path($scan->url));
                $scan->delete();
            }
            $chapter->delete();
        }
        $manga->tags()->detach();
        $manga->genres()->detach();
        $manga->delete();
        return redirect()->route('titles');

    })->name('titles.delete');

    Route::get('/chapters', Admin\Chapters\ChaptersController::class)->name('chapter');
    Route::get('/chapters/{chapter}/edit', function (Chapter $chapter) {
        $content = [
            'robots'=>'ALL, NOARCHIVE',
            'title_page'=>'Редактирование '.$chapter->title_ru,
            'description'=>'Что-то',
            'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
            'chapter'=>$chapter
        ];

        return view('admin.chapters.edit', compact('content'));
    })->name('chapter.edit');
    Route::get('/chapters/create', function () {
        $content = [
            'robots'=>'ALL, NOARCHIVE',
            'title_page'=>'Добавление новой главы',
            'description'=>'Что-то',
            'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
        ];

        return view('admin.chapters.create', compact('content'));
    })->name('chapter.create');
    Route::post('/chapters', Admin\Chapters\StoreController::class)->name('chapter.store');
    Route::patch('/chapters', Admin\Chapters\UpdateController::class)->name('chapter.update');
    Route::delete('/chapters/{chapter}', function (Chapter $chapter) {

        foreach ($chapter->scans as $scan) {
            unlink(public_path($scan->url));
                $scan->delete();
        }
        $chapter->delete();

        return redirect()->route('chapter');

    })->name('chapter.delete');
    Route::post('/chapter/images', Admin\Chapters\Image\StoreController::class)->name('image.store');
    Route::delete('/scan/{scan}', function (Scans $scan) {

        unlink(public_path($scan->url));
        $scan->delete();

        return redirect()->route('chapter.edit', $scan->chapter);

    })->name('image.delete');

});



