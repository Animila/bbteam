<?php

namespace App\Http\Controllers\Admin\Genres;

use App\Models\Genre;
use Illuminate\Support\Facades\Gate;

class GenresController extends BaseController
{
    public function __invoke()
    {
        if (Gate::check('for_admin_user')){
            $genre = Genre::all();
            $content = [
                'robots'=>'ALL, NOARCHIVE',
                'title_page'=>'Теги',
                'description'=>'Список тегов',
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
                'genre'=>$genre
            ];
            return view('admin.genres.index', compact('content'));
        } else {
            return back();
        }

    }
}
