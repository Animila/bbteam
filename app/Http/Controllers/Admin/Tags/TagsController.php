<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TagsController extends BaseController
{
    public function __invoke()
    {
        if (Gate::check('for_admin_user')){
            $tags = Tag::all();
            $content = [
                'robots'=>'ALL, NOARCHIVE',
                'title_page'=>'Теги',
                'description'=>'Список тегов',
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
                'tags'=>$tags
            ];
            return view('admin.tags.index', compact('content'));
        } else {
            return back();
        }

    }
}
