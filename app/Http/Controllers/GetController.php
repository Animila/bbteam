<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Manga;
use App\Models\Tag;

class GetController extends Controller
{
    public function __invoke()
    {
        $manga = Manga::find(3);
        $image = Genre::find(2)->mangas;
        return view('welcome', compact('manga', 'image'));
    }
}

//select
// `manga_tags`.*,
// `manga_tags`.`id_manga` as `pivot_id_manga`,
// `manga_tags`.`id` as `pivot_id` from `manga_tags`
// inner join `manga_tags`
// on `manga_tags`.`id` = `manga_tags`.`id`
// where `manga_tags`.`id_manga` = 1
