<?php

namespace App\Http\Controllers\Admin\Titles;

use App\Models\Manga;
use Illuminate\Support\Facades\Gate;
use function back;
use function view;

class TitlesController extends BaseController
{
    public function __invoke()
    {
        if (Gate::check('for_admin_user')){
            $manga = Manga::all();
            $content = [
                'robots'=>'ALL, NOARCHIVE',
                'title_page'=>'Каталог тайтлов',
                'description'=>'Список тайтлов',
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
                'manga'=>$manga
            ];
        return view('admin.titles.index', compact('content'));
    } else {
        return back();
    }
    }
}
