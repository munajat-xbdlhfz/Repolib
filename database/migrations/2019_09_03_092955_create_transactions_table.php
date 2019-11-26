<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('peminjaman_id');
            $table->integer('user_id')->unsigned();
            $table->string('kode_peminjaman')->unique();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('bibliografi_id')->unsigned();
            $table->foreign('bibliografi_id')->references('bibliografi_id')->on('bibliografis');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_batas_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->integer('status')->unsigned();
            $table->foreign('status')->references('id')->on('transaction_statuses');
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
        Schema::dropIfExists('transactions');
    }
}
