<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DeleteController extends BaseController
{
    public function __invoke(Tag $tag)
    {
        if (Gate::check('for_admin_user')){
            $tag->delete();
            return redirect()->route('tags');
        } else {
            return back();
        }

    }
}
