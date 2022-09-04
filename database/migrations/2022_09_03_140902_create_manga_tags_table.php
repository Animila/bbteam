<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMangaTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manga_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_manga');
            $table->unsignedBigInteger('id_tags');
            $table->timestamps();

            $table->index('id_manga', 'manga_tags_manga_idx');
            $table->index('id_tags', 'manga_tags_tags_idx');

            $table->foreign('id_manga', 'manga_tags_manga_fx')->on('mangas')->references('id');
            $table->foreign('id_tags', 'manga_tags_tags_fx')->on('tags')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manga_tags');
    }
}
