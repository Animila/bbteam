<?php

namespace App\Http\Controllers\Admin\Genres;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EditController extends BaseController
{
    public function __invoke(Genre $genre)
    {
        if (Gate::check('for_admin_user')){
            $content = [
                'robots'=>'DENY',
                'title_page'=>'Редактирование',
                'description'=>'Редактирование'.$genre->title,
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
                'genre'=>$genre
            ];
            return view('admin.genres.edit', compact('content'));
        } else {
            return back();
        }

    }
}
