<?php

namespace App\Http\Resources;

use App\Models\Status;
use App\Models\Type;
use Illuminate\Http\Resources\Json\JsonResource;

class MangaResource extends JsonResource
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
            'title_eng'=>$this->title_eng,
            'title_ru'=>$this->title_ru,
            'title_korean'=>$this->title_korean,
            'text'=>$this->text,
            'censor'=>$this->censor ? true : false,
            'type'=>Type::find($this->id_type)->title,
            'status'=>Status::find($this->id_status)->title,
        ];
    }
}
