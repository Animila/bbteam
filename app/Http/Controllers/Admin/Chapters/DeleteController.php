<?php

namespace App\Http\Controllers\Admin\Chapters;

use App\Models\Chapter;
use Illuminate\Support\Facades\Gate;
use function back;
use function view;

class DeleteController extends BaseController
{
    public function __invoke(Chapter $chapter)
    {
        if (Gate::check('for_admin_user')){
            foreach ($chapter->scans as $scan) {
                unlink(public_path($scan->url));
                $scan->delete();
            }
            $chapter->delete();

            return redirect()->route('chapter');
    } else {
        return back();
    }
    }
}
