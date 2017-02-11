<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCisFilemanagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cis_filemanagers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cis_lembaga_id')->unsigned();
            $table->foreign('cis_lembaga_id')->references('id')->on('cis_lembagas');
            $table->string('tipe'); //konsultan dan aktifitas
            $table->string('photo');
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
        Schema::dropIfExists('cis_filemanagers');
    }
}
