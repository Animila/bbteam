<?php

namespace App\Service\Admin;

use App\Models\Chapter;

class ChapterService
{

    public function ChaptersStore($data) {
        $data['hide'] = isset($data['hide']);
        $data['premium_access'] = isset($data['premium_access']);
        unset($data['hide_18']);
        return (Chapter::create($data));

    }

    public function ChaptersUpdate($data) {

        $chapter = Chapter::find($data['id_chapter']);
        $data['hide'] = isset($data['hide']);
        $data['premium_access'] = isset($data['premium']);
        unset($data['hide_18']);
        unset($data['id_chapter']);
        unset($data['premium']);
        $chapter->update($data);

        return $chapter->id;
    }
}
