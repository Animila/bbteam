<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $guarded = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mangas()
    {
        return $this->belongsToMany(\App\Models\Genre::class, 'manga_genres', 'id_genres', 'id_manga');
    }
}
