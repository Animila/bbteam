<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMangasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mangas', function (Blueprint $table) {
            $table->id();
            $table->string('title_eng');
            $table->string('title_ru');
            $table->string('title_korean')->nullable();
            $table->text('text');
            $table->boolean('censor')->default(false);
            $table->unsignedBigInteger('id_type');
            $table->unsignedBigInteger('id_status');
            $table->timestamps();
            $table->softDeletes();

            $table->index('id_type', 'manga_type_idx');
            $table->index('id_status', 'manga_status_idx');

            $table->foreign('id_type', 'manga_type_fk')->on('types')->references('id');
            $table->foreign('id_status', 'manga_status_fk')->on('statuses')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mangas');
    }
}
