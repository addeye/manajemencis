<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentraBinaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentra_binaans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cis_lembaga_id')->unsigned();
            $table->foreign('cis_lembaga_id')->references('id')->on('cis_lembagas');
            $table->string('nama_sentra');
            $table->string('jml_ukmk_sentra');
            $table->string('bidang_usaha_sentra');
            $table->string('wilayah_pemasaran');
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
        Schema::dropIfExists('sentra_binaans');
    }
}
