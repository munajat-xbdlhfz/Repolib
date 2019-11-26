<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestBookGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_book_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guest_books')->onDelete('cascade');
            $table->string('no_hp')->nullable();
            $table->string('nama_lembaga')->nullable();
            $table->string('no_hp_lembaga')->nullable();
            $table->string('email_lembaga')->nullable();
            $table->string('alamat_lembaga')->nullable();
            $table->integer('jumlah_peserta')->nullable();
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
        Schema::dropIfExists('guest_book_groups');
    }
}
