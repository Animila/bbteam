<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EditController extends BaseController
{
    public function __invoke(User $user)
    {
        if (Gate::check('for_admin_user')){
            $content = [
                'robots'=>'DENY',
                'title_page'=>'Редактирование',
                'description'=>'Редактирование'.$user->nickname,
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа',
                'user'=>$user
            ];
            return view('admin.users.edit', compact('content'));
        } else {
            return back();
        }

    }
}
