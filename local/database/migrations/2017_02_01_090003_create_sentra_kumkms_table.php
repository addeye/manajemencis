<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentraKumkmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentra_kumkms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_lembaga');
            $table->string('id_sentra');
            $table->string('name');
            $table->string('provinces_id');
            $table->foreign('provinces_id')->references('id')->on('provinces');
            $table->string('regency_id');
            $table->foreign('regency_id')->references('id')->on('regencies');
            $table->string('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->bigInteger('village_id');
            $table->foreign('village_id')->references('id')->on('villages');
            $table->text('alamat');
            /*teknis*/
            $table->string('tahun_berdiri');
            $table->integer('bidang_usaha_id')->unsigned();
            $table->foreign('bidang_usaha_id')->references('id')->on('bidang_usahas');
            $table->integer('total_umkm');
            $table->integer('total_pegawai');
            $table->integer('omset_bulan');
            $table->string('teknologi'); //tradisonal, sederhana, dan modern
            $table->string('bahan_baku'); //lokal, impor
            $table->string('pemasaran'); //lokal, ekspor
            $table->string('kemitraan');
            $table->string('nama_ketua');
            $table->string('notelp_ketua');
            $table->string('email_ketua');
            $table->string('name_cp');
            $table->string('no_cp');
            $table->string('email_cp');
            /*Pembina*/
            $table->string('pembina_kementrian');
            $table->string('pembina_bidang');
            $table->string('pembina_tenaga_pendamping');
            /*permasalahan*/
            $table->text('masalah_kelembagaan');
            $table->text('masalah_sdm');
            $table->text('masalah_produksi');
            $table->text('masalah_pembiayaan');
            $table->text('masalah_pemasaran');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sentra_kumkms');
    }
}
