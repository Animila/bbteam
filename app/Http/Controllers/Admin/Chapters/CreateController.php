<?php

namespace App\Http\Controllers\Admin\Chapters;

use App\Models\Chapter;
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
                'title_page'=>'Добавление новой главы',
                'description'=>'Что-то',
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
            ];

            return view('admin.chapters.create', compact('content'));
    } else {
        return back();
    }
    }
}
