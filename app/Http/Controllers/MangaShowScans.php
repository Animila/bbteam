<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Support\Facades\Gate;

class MangaShowScans extends Controller
{
    public function __invoke($manga, Chapter $chapter)
    {
        if ($chapter->premium_access && !Gate::check('for_premium_user')) {
            dd('нет премиума');
        }
        foreach ($chapter->scans as $scan) {
            echo '<img src="'.$scan->url.'">';
        }
        echo '<a href="/">Назад</a>';
        dd('');
    }
}
