<?php

namespace App\Models\Traits;

use App\Models\Image;

trait Imageable
{
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getImage($type) {
        return $this->morphMany(Image::class, 'type', $type);
    }

    public function newImages($url, $type)
    {
        return $this->images()->create([
            'url'=>$url,
            'imageable_id'=>$this->get()->first()->id,
            'imageable_type'=>get_class($this),
            'type'=>$type
        ]);
    }
//    public function updateImages($url, $type, $id)
//    {
//        return $this->images()->where('id', $id);
////            ->create([
////            'url'=>$url,
////            'imageable_id'=>$this->get()->first()->id,
////            'imageable_type'=>get_class($this),
////            'type'=>$type
////        ]);
//    }
}
