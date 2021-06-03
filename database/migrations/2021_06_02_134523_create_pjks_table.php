<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pjks', function (Blueprint $table) {
            $table->id();
            $table->String('judul');
            $table->date('tanggal');
            $table->integer('lampiran');
            $table->String('praktikum');
            $table->string('periode');
            $table->integer('lulus');
            $table->integer('tidaklulus');
            $table->integer('gugur');
            $table->integer('jumlahpeserta');
            $table->integer('jumlahkelas');
            $table->integer('jumlahpesertaperkelas');
            $table->integer('jumlahmodul');
            $table->integer('lamapraktikum');
            $table->integer('sks');
            $table->integer('sertifikat');
            $table->integer('operasional');
            $table->integer('koordinator');
            $table->integer('administrator');
            $table->integer('kebersihan');
            $table->integer('bimbingan');
            $table->integer('honorarium');
            $table->integer('biayamodul');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('pjks');
    }
}
