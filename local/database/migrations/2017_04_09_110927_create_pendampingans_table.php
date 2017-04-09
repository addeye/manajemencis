<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendampingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendampingan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kumkm_id')->unsigned()->nullable();
            $table->foreign('kumkm_id')->references('id')->on('kumkm')->onDelete('cascade');
            $table->date('tanggal_pendampingan');
            $table->text('permasalahan');
            $table->text('saran_tindakan');
            $table->text('tindak_lanjut');
            $table->integer('user_id')->unsigned()->nullable();
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
        Schema::dropIfExists('pendampingan');
    }
}
