<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UpdateController extends BaseController
{
    public function __invoke(Request $request, Tag $tag)
    {
        if (Gate::check('for_admin_user')){
            $data = $request->get('title');
            $tag->update([
                'title'=>$data
            ]);
            return redirect()->route('tags.edit', $tag->id);
        } else {
            return back();
        }

    }
}
