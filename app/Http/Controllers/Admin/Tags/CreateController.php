<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CreateController extends BaseController
{
    public function __invoke()
    {
        if (Gate::check('for_admin_user')){
            $content = [
                'robots'=>'DENY',
                'title_page'=>'Создание',
                'description'=>'Создание',
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
            ];
            return view('admin.tags.create', compact('content'));
        } else {
            return back();
        }

    }
}
