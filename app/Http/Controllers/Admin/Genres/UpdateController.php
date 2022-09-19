<?php

namespace App\Http\Controllers\Admin\Genres;

use App\Models\Genre;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UpdateController extends BaseController
{
    public function __invoke(Request $request, Genre $genre)
    {
        if (Gate::check('for_admin_user')){
            $data = $request->get('title');
            $genre->update([
                'title'=>$data
            ]);
            return redirect()->route('genres.edit', $genre->id);
        } else {
            return back();
        }

    }
}
