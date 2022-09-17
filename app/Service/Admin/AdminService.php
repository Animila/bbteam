<?php

namespace App\Service\Admin;

use App\Models\Chapter;
use App\Models\Manga;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminService
{

    public function TitlesStore($data) {
        $path = '/images/titles/'.str_replace(' ', '_', $data['title_eng']);
        $Image = Storage::putFileAs($path, $data['image'], $data['image']->getClientOriginalName());

        $tags = $data['id_tags'];
        $genres = $data['id_genres'];
        $data['text'] = $data['description'];
        $data['censor'] =isset($data['hide_18']);
        $data['hide'] = isset($data['hide']);

        unset($data['image']);
        unset($data['id_tags']);
        unset($data['id_genres']);
        unset($data['description']);
        unset($data['hide_18']);


        $new_titles = Manga::create($data);
        $new_titles->tags()->attach($tags);
        $new_titles->genres()->attach($genres);
        $new_titles->newImages($Image, 'title');

    }
    public function TitlesUpdate($data) {
        if(isset($data['image'])) {
            $path = '/images/titles/'.str_replace(' ', '_', $data['title_eng']);
            $Image = Storage::putFileAs($path, $data['image'], $data['image']->getClientOriginalName());
            unset($data['image']);
        }

        $manga = Manga::find($data['id_manga']);
        $tags = $data['id_tags'];
        $genres = $data['id_genres'];
        $data['text'] = $data['description'];
        $data['censor'] =isset($data['hide_18']);
        $data['hide'] = isset($data['hide']);

        unset($data['image']);
        unset($data['id_tags']);
        unset($data['id_genres']);
        unset($data['description']);
        unset($data['hide_18']);
        unset($data['id_manga']);



        $manga->update($data);
        $manga->tags()->sync($tags);
        $manga->genres()->sync($genres);

        if(isset($data['image'])) {
            dd($manga->images());
        }
        $manga->images()->first()->update([
            'url'=>$Image,
        ]);
        return $manga->id;
    }

    public function ChaptersStore($data) {

//        !!!ПОЧИНИТЬ
//        isset($data['hide_18']);
        $data['hide'] = isset($data['hide']);
        $data['premium_access'] = isset($data['premium_access']);
        unset($data['hide_18']);
        return (Chapter::create($data));

    }

    public function ChaptersUpdate($data) {

//        !!!ПОЧИНИТЬ
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
