<?php

namespace App\Http\Controllers\Admin\Genres;

use App\Models\Genre;
use Illuminate\Support\Facades\Gate;

class DeleteController extends BaseController
{
    public function __invoke(Genre $genre)
    {
        if (Gate::check('for_admin_user')){
            $genre->delete();
            return redirect()->route('genres');
        } else {
            return back();
        }

    }
}
