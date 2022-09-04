<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_chapter');
            $table->string('url');
            $table->integer('number');
            $table->timestamps();

            $table->index('id_chapter', 'scan_chapter_idx');
            $table->foreign('id_chapter', 'scan_chapter_fk')->on('chapters')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scans');
    }
}
