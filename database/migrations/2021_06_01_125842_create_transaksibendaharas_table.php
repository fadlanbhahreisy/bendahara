<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksibendaharasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksibendaharas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('keterangan', 100);
            $table->double('nominal');
            $table->string('gambar')->nullable();
            $table->boolean('status');
            $table->bigInteger('jenistransaksi_id')->unsigned();
            $table->foreign('jenistransaksi_id')->references('id')->on('jenistransaksis')->onDelete('cascade');
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
        Schema::dropIfExists('transaksibendaharas');
    }
}
