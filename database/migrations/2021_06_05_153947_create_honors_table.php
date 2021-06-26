<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('honors', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('status', 50);
            $table->integer('sks')->nullable();
            $table->integer('biayakhusus')->nullable();
            $table->integer('hdr')->nullable();
            $table->integer('jumlahbimb')->nullable();
            $table->integer('hrbimb')->nullable();
            $table->integer('total');
            $table->integer('honorpraktikum');
            $table->bigInteger('pjk_id')->unsigned();
            $table->foreign('pjk_id')->references('id')->on('pjks')->onDelete('cascade');
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
        Schema::dropIfExists('honors');
    }
}
