<?php

namespace App\Http\Controllers\Admin\Chapters;

use App\Models\Chapter;
use Illuminate\Support\Facades\Gate;
use function back;
use function view;

class ChaptersController extends BaseController
{
    public function __invoke()
    {
        if (Gate::check('for_admin_user')){
            $chapter = Chapter::all();
            $content = [
                'robots'=>'ALL, NOARCHIVE',
                'title_page'=>'Каталог тайтлов',
                'description'=>'Список тайтлов',
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
                'chapters'=>$chapter
            ];
        return view('admin.chapters.index', compact('content'));
    } else {
        return back();
    }
    }
}
