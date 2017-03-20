<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKumkmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kumkm', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lembaga_id')->unsigned()->nullable();
            $table->foreign('lembaga_id')->references('id')->on('cis_lembagas');
            $table->string('nama_usaha');
            $table->string('nama_pemilik')->nullable();
            $table->string('id_kumkm')->nullable();
            $table->string('telp')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('npwp')->nullable();
            $table->string('email')->nullable();
            $table->string('badan_usaha')->nullable();
            $table->string('ket_badan_usaha')->nullable();
            $table->string('tgl_mulai_usaha')->nullable();
            $table->string('sektor_usaha')->nullable();
            $table->string('skala_usaha')->nullable();
            $table->string('usaha_utama')->nullable();
            $table->string('hasil_produk')->nullable();
            $table->integer('sentra')->default(0);
            $table->integer('sentra_id')->unsigned()->nullable();
            $table->foreign('sentra_id')->references('id')->on('sentra_kumkms');
            $table->integer('tk_tetap')->nullable();
            $table->integer('tk_tidak_tetap')->nullable();
            $table->string('foto_usaha')->nullable();

            $table->string('provinces_id')->nullable();
            $table->foreign('provinces_id')->references('id')->on('provinces');
            $table->string('regency_id')->nullable();
            $table->foreign('regency_id')->references('id')->on('regencies');
            $table->string('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->bigInteger('village_id')->nullable();
            $table->text('alamat')->nullable();

            $table->integer('kas_tunai')->nullable();
            $table->integer('persediaan')->nullable();
            $table->integer('harga_tetap')->nullable();

            $table->integer('kw_bank')->nullable();
            $table->integer('kw_koperasi')->nullable();
            $table->integer('kw_lainnya')->nullable();

            $table->integer('kp_sertifikat')->nullable();
            $table->integer('kp_tidak_sertifikat')->nullable();

            $table->integer('om_1thn_lalu')->nullable();
            $table->integer('om_2thn_lalu')->nullable();

            $table->integer('lb_1thn_lalu')->nullable();
            $table->integer('lb_2thn_lalu')->nullable();

            $table->integer('laporan_regular')->nullable();

            $table->string('p1_nama_produk')->nullable();
            $table->text('p1_deskripsi')->nullable();
            $table->integer('p1_harga')->nullable();
            $table->string('p1_foto_produk')->nullable();

            $table->string('p2_nama_produk')->nullable();
            $table->text('p2_deskripsi')->nullable();
            $table->integer('p2_harga')->nullable();
            $table->string('p2_foto_produk')->nullable();

            $table->string('p3_nama_produk')->nullable();
            $table->text('p3_deskripsi')->nullable();
            $table->integer('p3_harga')->nullable();
            $table->string('p3_foto')->nullable();

            $table->string('izin_produk')->nullable();
            $table->string('izin_usaha_iumk')->nullable();
            $table->string('izin_usaha_siui')->nullable();
            $table->string('izin_usaha_siup')->nullable();
            $table->string('legalitas_lokasi')->nullable();
            $table->string('jangkauan_pasar')->nullable();

            $table->string('terima_pendampingan')->nullable();
            $table->text('masalah_lembaga')->nullable();
            $table->text('masalah_sdm')->nullable();
            $table->text('masalah_produksi')->nullable();
            $table->text('masalah_pembiayaan')->nullable();
            $table->text('masalah_pemasaran')->nullable();
            $table->text('masalah_lainnya')->nullable();

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
        Schema::dropIfExists('kumkm');
    }
}
