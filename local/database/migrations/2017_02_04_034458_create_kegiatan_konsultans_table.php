<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanKonsultansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_konsultans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('konsultan_id')->unsigned();
            $table->foreign('konsultan_id')->references('id')->on('konsultans');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('nama_kegiatan');
            $table->integer('jenis_layanan_id')->unsigned();
            $table->foreign('jenis_layanan_id')->references('id')->on('jenis_layanans');
            $table->integer('bidang_usaha_id')->unsigned();
            $table->foreign('bidang_usaha_id')->references('id')->on('bidang_usahas');
            $table->string('lokasi_kegiatan');
            $table->integer('jumlah_peserta');
            $table->integer('output');
            $table->string('sumber_daya');
            $table->string('mitra_kegiatan');
            $table->text('rencana_tindak_lanjut');
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
        Schema::dropIfExists('kegiatan_konsultans');
    }
}
