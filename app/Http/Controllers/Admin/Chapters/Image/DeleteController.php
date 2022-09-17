<?php

namespace App\Http\Controllers\Admin\Chapters\Image;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Scans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DeleteController extends Controller
{
    public function __invoke(Scans $scan)
    {
        unlink(public_path($scan->url));
        $scan->delete();

        return redirect()->route('chapter.edit', $scan->chapter);

    }
}
