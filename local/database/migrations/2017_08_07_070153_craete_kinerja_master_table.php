<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CraeteKinerjaMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kinerja_master', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('standart_layanan_id')->unsigned();
            $table->foreign('standart_layanan_id')->references('id')->on('standart_layanan');
            $table->string('sasaran');
            $table->string('target');
            $table->string('tahun');
            $table->integer('cis_lembaga_id')->unsigned();
            $table->foreign('cis_lembaga_id')->references('id')->on('cis_lembagas');
            $table->string('triwulan1')->nullable();
            $table->string('triwulan2')->nullable();
            $table->string('triwulan3')->nullable();
            $table->string('triwulan4')->nullable();            
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
        Schema::dropIfExists('kinerja_master');
    }
}
