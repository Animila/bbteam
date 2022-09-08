<?php

use App\Http\Controllers\Account\RegisterController;
use App\Http\Resources\MangaChapterResource;
use App\Http\Resources\MangaResource;
use App\Http\Resources\ScansResource;
use App\Models\Chapter;
use App\Models\Manga;
use Illuminate\Http\Request;
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

Route::middleware('guest')->post('/register', Account\RegisterController::class);

Route::prefix('/manga')->group(function () {
    Route::get('/', function () {
        return MangaResource::collection(Manga::all());
    });
    Route::get('/{manga}', function (Manga $manga) {
        return new MangaResource($manga);
    });
    Route::get('/{manga}/chapters', function (Manga $manga) {
        return MangaChapterResource::collection($manga->chapters);
    });
    Route::get('/{manga}/chapters/{chapter}', function (Manga $manga, Chapter $chapter) {
        return new MangaChapterResource($chapter);
    });
    Route::middleware('auth:sanctum')->get('/{manga}/chapters/{chapter}/scans', function (Manga $manga, Chapter $chapter) {
        if (Gate::check('for_premium_user')) {
            return ScansResource::collection($chapter->scans);
        } else {
            return [
                'status'=> false,
                'error'=>'не премиум'
            ];
        }
    });
});
