<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentPasarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_pasar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('informasi_pasar_id')->unsigned();
            $table->foreign('informasi_pasar_id')->references('id')->on('informasi_pasar');
            $table->string('nama');
            $table->string('email');
            $table->text('komentar');
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
        Schema::dropIfExists('comment_pasar');
    }
}
