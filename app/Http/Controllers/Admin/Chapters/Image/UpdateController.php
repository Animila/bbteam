<?php

namespace App\Http\Controllers\Admin\Chapters\Image;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Scans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class UpdateController extends Controller
{
    public function __invoke(Request $request)
    {
        dd('СДЕЛАТь');
    }
}
