<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BanController extends BaseController
{
    public function __invoke(User $user)
    {
        if (Gate::check('for_admin_user')){
            $user->update([
                'hide'=>true
            ]);

            return back();
        } else {
            return back();
        }

    }
}
