<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_manga');
            $table->integer('tom')->default(1);
            $table->integer('number')->default(1);
            $table->boolean('hide')->default(false);
            $table->string('title')->nullable();
            $table->boolean('premium_access')->default(false);
            $table->dateTime('date_of_free');
            $table->timestamps();

            $table->index('id_manga', 'chapter_manga_idx');
            $table->foreign('id_manga', 'chapter_manga_fk')->on('mangas')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapters');
    }
}
