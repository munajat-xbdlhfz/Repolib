<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBibliografisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bibliografis', function (Blueprint $table) {
            $table->increments('bibliografi_id');
            $table->string('isbn')->nullable();
            $table->string('no_panggil')->nullable();
            $table->string('judul');
            $table->string('anak_judul')->nullable();
            $table->string('edisi')->nullable();
            $table->integer('publisher_id')->unsigned();
            $table->foreign('publisher_id')->references('id')->on('users');
            $table->integer('jenis_sumber_id')->nullable()->unsigned();
            $table->foreign('jenis_sumber_id')->references('id')->on('source_types');
            $table->string('nama_sumber')->nullable();
            $table->string('bentuk_fisik')->nullable();
            $table->integer('bahasa_id')->nullable()->unsigned();
            $table->foreign('bahasa_id')->references('id')->on('languages');
            $table->integer('kategori_id')->nullable()->unsigned();
            $table->foreign('kategori_id')->references('id')->on('categories');
            $table->integer('akses_id')->nullable()->unsigned();
            $table->foreign('akses_id')->references('id')->on('accesses');
            $table->integer('lokasi_id')->nullable()->unsigned();
            $table->foreign('lokasi_id')->references('id')->on('locations');
            $table->string('mata_uang_id')->nullable();
            $table->foreign('mata_uang_id')->references('code')->on('currencies');
            $table->double('harga', 11, 2)->nullable();
            $table->date('tanggal_pengadaan');
            $table->string('create_token');
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
        Schema::dropIfExists('bibliografis');
    }
}
