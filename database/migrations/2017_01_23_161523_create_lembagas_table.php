<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLembagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembagas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('tingkat_id')->unsigned();
            $table->foreign('tingkat_id')->references('id')->on('tingkats');
            $table->string('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->text('alamat');
            $table->string('kode_pos');
            $table->string('SKPD');
            $table->string('tahun_berdiri');
            $table->string('telepon');
            $table->string('email')->unique();
            $table->string('nama_pimpinan');
            $table->string('telepon_pimpinan');
            $table->string('email_pimpinan');
            $table->string('nama_admin');
            $table->string('telepon_admin');
            $table->string('email_admin');
            $table->string('nama_staffgalery');
            $table->string('telepon_staffgalery');
            $table->string('email_staffgalery');
            $table->string('nama_staffteknis');
            $table->string('telepon_staffteknis');
            $table->string('email_staffteknis');
            $table->string('nama_kons_kelembagaan');
            $table->string('telepon_kons_kelembagaan');
            $table->string('email_kons_kelembagaan');
            $table->string('nama_kons_sdm');
            $table->string('telepon_kons_sdm');
            $table->string('email_kons_sdm');
            $table->string('nama_kons_produksi');
            $table->string('telepon_kons_produksi');
            $table->string('email_kons_produksi');
            $table->string('nama_kons_pembiayaan');
            $table->string('telepon_kons_pembiayaan');
            $table->string('email_kons_pembiayaan');
            $table->string('nama_kons_pemesaran');
            $table->string('telepon_kons_pemasaran');
            $table->string('email_kons_pemasaran');
            $table->string('nama_kons_it');
            $table->string('telepon_kons_it');
            $table->string('email_kons_it');
            $table->string('nama_kons_kerjasama');
            $table->string('telepon_kons_kerjasama');
            $table->string('email_kons_kerjasama');
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
        Schema::dropIfExists('lembagas');
    }
}
