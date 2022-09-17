<?php

namespace App\Http\Controllers\Admin\Chapters;

use App\Models\Chapter;
use Illuminate\Support\Facades\Gate;
use function back;
use function view;

class EditController extends BaseController
{
    public function __invoke(Chapter $chapter)
    {
        if (Gate::check('for_admin_user')){
            $content = [
                'robots'=>'ALL, NOARCHIVE',
                'title_page'=>'Редактирование '.$chapter->title_ru,
                'description'=>'Что-то',
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
                'chapter'=>$chapter
            ];

            return view('admin.chapters.edit', compact('content'));
    } else {
        return back();
    }
    }
}
