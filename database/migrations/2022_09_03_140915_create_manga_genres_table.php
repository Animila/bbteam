<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMangaGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manga_genres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_manga');
            $table->unsignedBigInteger('id_genres');
            $table->timestamps();

            $table->index('id_manga', 'manga_genre_manga_idx');
            $table->index('id_genres', 'manga_genre_genres_idx');

            $table->foreign('id_manga', 'manga_genre_manga_fx')->on('mangas')->references('id');
            $table->foreign('id_genres', 'manga_genre_genres_fx')->on('genres')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manga_genres');
    }
}
