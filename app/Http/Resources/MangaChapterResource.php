<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MangaChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'tom'=>$this->tom,
            'number'=>$this->number,
            'title'=>$this->title,
            'premium'=>$this->premium_access ? true : false,

        ];
    }
}
