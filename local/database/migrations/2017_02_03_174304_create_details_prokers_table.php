<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsProkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_prokers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proker_id')->unsigned();
            $table->foreign('proker_id')->references('id')->on('proker_konsultans');
            $table->string('jenis_kegiatan');
            $table->string('tujuan');
            $table->integer('jenis_layanan_id')->unsigned();
            $table->foreign('jenis_layanan_id')->references('id')->on('jenis_layanans');
            $table->integer('output');
            $table->string('ket_output');
            $table->integer('jml_penerima');
            $table->integer('anggaran');
            $table->string('jadwal_pelaksana');
            $table->string('mitra_kerja');
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
        Schema::dropIfExists('details_prokers');
    }
}
