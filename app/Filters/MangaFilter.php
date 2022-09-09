<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class MangaFilter extends AbstractFilter
{
    const SEARCH = 'search';
    const TYPES = 'types';
    const STATUS = 'status';
    const CENSOR = 'censor';
    const TAGS = 'tags';
    const GENRES = 'genres';

    protected function getCallbacks(): array
    {
        return [
            self::CENSOR => [$this, 'censor'],
            self::SEARCH => [$this, 'search'],
            self::TYPES => [$this, 'types'],
            self::STATUS => [$this, 'status'],
            self::TAGS => [$this, 'tags'],
            self::GENRES => [$this, 'genres'],
        ];
    }
    protected function search(Builder $builder, $value)
    {
        $builder
            ->where('title_ru', 'LIKE', '%'.$value.'%')
            ->orWhere('title_eng', 'LIKE', '%'.$value.'%')
            ->orWhere('title_korean', 'LIKE', '%'.$value.'%')
            ->orWhere('text', 'LIKE', '%'.$value.'%');

    }

    protected function types(Builder $builder, $value) {
        $builder->whereHas('type', function ($b) use ($value) {
            $b->whereIn('id_type', $value);
        });
    }

    protected function status(Builder $builder, $value) {
        $builder->whereHas('status', function ($b) use ($value) {
            $b->whereIn('id_status', $value);
        });
    }

    protected function censor(Builder $builder, $value) {
        return $builder->where('censor', $value)->get();
    }

    protected function tags(Builder $builder, $value) {
        $builder->whereHas('tags', function ($b) use ($value) {
            $b->whereIn('id_tags', $value);
        } );
    }
    protected function genres(Builder $builder, $value) {

    }
}
