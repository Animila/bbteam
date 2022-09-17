<?php

namespace App\Http\Controllers\Admin\Titles;

use App\Models\Manga;
use Illuminate\Support\Facades\Gate;
use function back;
use function view;

class DeleteController extends BaseController
{
    public function __invoke(Manga $manga)
    {
        if (Gate::check('for_admin_user')){

            unlink(public_path($manga->images()->first()->url));
            $manga->images()->first()->delete();
            foreach ($manga->chapters as $chapter) {
                foreach ($chapter->scans as $scan) {
                    unlink(public_path($scan->url));
                    $scan->delete();
                }
                $chapter->delete();
            }
            $manga->tags()->detach();
            $manga->genres()->detach();
            $manga->delete();
            return redirect()->route('titles');
        } else {
            return back();
        }
    }
}
