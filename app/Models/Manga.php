<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;
    protected $guarded = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(\App\Models\Status::class, 'id', 'id_status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(\App\Models\Type::class, 'id', 'id_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chapters()
    {
        return $this->hasMany(\App\Models\Chapter::class, 'id_manga', 'id');
    }


    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'manga_tags', 'id_manga', 'id_tags');
    }

    public function genres()
    {
        return $this->belongsToMany(\App\Models\Genre::class, 'manga_genres', 'id_manga','id_genres');
    }
}
