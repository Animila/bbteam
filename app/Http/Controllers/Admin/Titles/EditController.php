<?php

namespace App\Http\Controllers\Admin\Titles;

use App\Models\Manga;
use Illuminate\Support\Facades\Gate;
use function back;
use function view;

class EditController extends BaseController
{
    public function __invoke(Manga $manga)
    {
        if (Gate::check('for_admin_user')){

            $content = [
                'robots'=>'ALL, NOARCHIVE',
                'title_page'=>'Редактирование '.$manga->title_ru,
                'description'=>'Что-то',
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
                'manga'=>$manga
            ];

            return view('admin.titles.edit', compact('content'));
        } else {
            return back();
        }
    }
}
