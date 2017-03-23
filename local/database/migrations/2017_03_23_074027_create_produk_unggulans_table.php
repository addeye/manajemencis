<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukUnggulansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_unggulan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_produk');
            $table->string('merek')->nullable();
            $table->string('bidang_usaha')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('kapasitas_perbulan')->nullable();
            $table->integer('omset_perbulan')->default(0);
            $table->string('nama_pemilik')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('provinces_id')->nullable();
            $table->foreign('provinces_id')->references('id')->on('provinces');
            $table->string('regency_id')->nullable();
            $table->foreign('regency_id')->references('id')->on('regencies');
            $table->string('telp')->nullable();
            $table->string('email')->nullable();
            $table->integer('sentra')->default(0);
            $table->integer('sentra_id')->default(0);
            $table->string('legalitas')->nullable();
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
        Schema::dropIfExists('produk_unggulan');
    }
}
