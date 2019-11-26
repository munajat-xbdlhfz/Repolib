<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cds', function (Blueprint $table) {
            $table->increments('cd_id');
            $table->integer('bibliografi_id')->unsigned();
            $table->foreign('bibliografi_id')->references('bibliografi_id')->on('bibliografis')->onDelete('cascade');
            $table->string('penerbit')->nullable();
            $table->string('tempat_terbit')->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->string('jumlah_keping')->nullable();
            $table->integer('pencipta_id')->nullable()->unsigned();
            $table->foreign('pencipta_id')->references('id')->on('songwriters');
            $table->integer('genre_id')->nullable()->unsigned();
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->string('cover')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cds');
    }
}
