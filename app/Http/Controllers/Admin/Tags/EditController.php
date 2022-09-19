<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EditController extends BaseController
{
    public function __invoke(Tag $tag)
    {
        if (Gate::check('for_admin_user')){
            $content = [
                'robots'=>'DENY',
                'title_page'=>'Редактирование',
                'description'=>'Редактирование'.$tag->title,
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
                'tag'=>$tag
            ];
            return view('admin.tags.edit', compact('content'));
        } else {
            return back();
        }

    }
}
