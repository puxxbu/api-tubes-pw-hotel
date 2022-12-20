<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_makanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama_pesanan'); // dimasukan dalam bentuk list ',' aja ex: ayam,tahu,es teh
            // $table->string('jenis');
            $table->integer('harga');
            // $table->string('jam_antar');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('pesanan_makanans');
    }
};