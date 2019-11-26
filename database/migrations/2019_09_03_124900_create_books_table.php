<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('buku_id');
            $table->integer('bibliografi_id')->unsigned();
            $table->foreign('bibliografi_id')->references('bibliografi_id')->on('bibliografis')->onDelete('cascade');
            $table->string('penerbit')->nullable();
            $table->string('tempat_terbit')->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->char('tinggi_buku')->nullable();
            $table->integer('jumlah_halaman')->nullable();
            $table->integer('jumlah_buku')->nullable();
            $table->integer('klasifikasi_buku_id')->nullable()->unsigned();
            $table->foreign('klasifikasi_buku_id')->references('id')->on('book_classifications');
            $table->integer('karya_tulis_id')->nullable()->unsigned();
            $table->foreign('karya_tulis_id')->references('id')->on('written_forms');
            $table->integer('jenis_buku_id')->nullable()->unsigned();
            $table->foreign('jenis_buku_id')->references('id')->on('book_types');
            $table->integer('subjek_id')->nullable()->unsigned();
            $table->foreign('subjek_id')->references('id')->on('book_subjects');
            $table->string('cover')->nullable();
            $table->string('file')->nullable();
            $table->enum('opac', ['show', 'hide']);
            $table->string('deskripsi')->nullable();
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
        Schema::dropIfExists('books');
    }
}
