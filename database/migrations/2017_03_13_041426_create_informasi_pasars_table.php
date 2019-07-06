<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformasiPasarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_pasar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('telp');
            $table->string('perusahaan')->nullable();
            $table->string('jenis')->nullable();
            $table->string('nama_produk')->nullable();
            $table->string('jumlah_produk')->nullable();
            $table->string('satuan_produk')->nullable();
            $table->string('harga_produk')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('informasi_pasar');
    }
}
