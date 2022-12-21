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
        Schema::create('data_penginaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nik'); // dimasukan dalam bentuk list ',' aja ex: ayam,tahu,es teh
            // $table->string('jenis');
            $table->string('nama');
            $table->string('wilayah');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
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
        Schema::dropIfExists('data_penginaps');
    }
};