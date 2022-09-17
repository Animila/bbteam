<?php

namespace App\Http\Controllers\Admin\Titles;

use App\Models\Manga;
use Illuminate\Support\Facades\Gate;
use function back;
use function view;

class CreateController extends BaseController
{
    public function __invoke()
    {
        if (Gate::check('for_admin_user')){

            $content = [
                'robots'=>'ALL, NOARCHIVE',
                'title_page'=>'Добавление нового тайтла',
                'description'=>'Что-то',
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
            ];

            return view('admin.titles.create', compact('content'));
        } else {
            return back();
        }
    }
}
