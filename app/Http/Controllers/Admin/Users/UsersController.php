<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends BaseController
{
    public function __invoke()
    {
        if (Gate::check('for_admin_user')){
            $users= User::all();
            $content = [
                'robots'=>'ALL, NOARCHIVE',
                'title_page'=>'Пользователи',
                'description'=>'Список пользователей',
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
                'users'=>$users
            ];
            return view('admin.users.index', compact('content'));
        } else {
            return back();
        }

    }
}
