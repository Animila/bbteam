<?php
namespace App\Http\Controllers;

use App\Filters\MangaFilter;
use App\Filters\QueryFilter;
use App\Http\Resources\GenresResource;
use App\Http\Resources\MangaChapterResource;
use App\Http\Resources\MangaResource;
use App\Http\Resources\ScansResource;
use App\Http\Resources\TagResource;
use App\Models\Chapter;
use App\Models\Genre;
use App\Models\Manga;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ДЛЯ МАНГИ
Route::get('/getMangas', function () {
    return MangaResource::collection(Manga::all());
});
Route::get('/getMangas.filters', function (Request $request) {
    return MangaResource::collection(Manga::filter(app()->make(MangaFilter::class, ['queryParams'=>array_filter($request->all())]))->get());
});
Route::get('/getManga', function (Request $request) {
    return new MangaResource(Manga::find($request->get('manga')));
});
Route::get('/getListChapters', function (Request $request) {
    return MangaChapterResource::collection(Manga::find($request->get('manga'))->chapters);
});
Route::middleware('auth:sanctum')->get('/getChapter', function (Request $request) {
    if (Gate::check('for_premium_user')) {
        return ScansResource::collection(Chapter::find($request->get('chapter'))->scans);
    } else {
        return [
            'status' => false,
            'error' => 'не премиум'
        ];
    }
});

// ДЛЯ ТЕГОВ
Route::get('/getTags', function () {
    return TagResource::collection(Tag::all());
});
Route::middleware('auth:sanctum')->post('/setNewTag', function (Request $request) {
    if (Gate::check('for_admin_user')) {
        $data =  $request->validate([
            'title'=>''
        ]);

        $tag = Tag::firstOrCreate([
            'title' => $data['title']
        ]);

        return new TagResource($tag);
    } else {
        return [
            'status' => false,
            'error' => 'не админ'
        ];
    }
});
Route::middleware('auth:sanctum')->post('/setTag', function (Request $request) {
    if (Gate::check('for_admin_user')) {
        $data =  $request->validate([
            'title'=>''
        ]);
        $tag =Tag::find($request->has('id'));

        $tag->update([
            'title' => $data['title']
        ]);

        return new TagResource($tag);
    } else {
        return [
            'status' => false,
            'error' => 'не админ'
        ];
    }
});

// ДЛЯ ЖАНРОВ
Route::get('/getGenres', function () {
    return GenresResource::collection(Genre::all());
});
Route::middleware('auth:sanctum')->post('/setNewTags', function (Request $request) {
    if (Gate::check('for_admin_user')) {
        $data =  $request->validate([
            'title'=>''
        ]);

        $tag = Genre::firstOrCreate([
            'title' => $data['title']
        ]);

        return new GenresResource($tag);
    } else {
        return [
            'status' => false,
            'error' => 'не админ'
        ];
    }
});
Route::middleware('auth:sanctum')->post('/setTag', function (Request $request) {
    if (Gate::check('for_admin_user')) {
        $data =  $request->validate([
            'title'=>''
        ]);
        $tag =Genre::find($request->has('id'));

        $tag->update([
            'title' => $data['title']
        ]);

        return new GenresResource($tag);
    } else {
        return [
            'status' => false,
            'error' => 'не админ'
        ];
    }
});
