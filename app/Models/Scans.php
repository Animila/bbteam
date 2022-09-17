<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scans extends Model
{
    use HasFactory;
    protected $guarded = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chapter()
    {
        return $this->belongsTo(\App\Models\Chapter::class, 'id_chapter', 'id');
    }
}
