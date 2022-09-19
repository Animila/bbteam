<?php

namespace App\Http\Controllers\Admin\Genres;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StoreController extends BaseController
{
    public function __invoke(Request $request, Genre $genre)
    {
        if (Gate::check('for_admin_user')){
            $data = $request->get('title');
            $genre->create([
                'title'=>$data
            ]);
            return redirect()->route('genres');
        } else {
            return back();
        }

    }
}
