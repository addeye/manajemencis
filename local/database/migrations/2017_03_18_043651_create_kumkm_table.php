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
            $table->integer('lembaga_id')->default(0);
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
            $table->integer('sentra_id')->default(0);
            $table->integer('tk_tetap')->default(0);
            $table->integer('tk_tidak_tetap')->default(0);
            $table->string('foto_usaha')->nullable();

            $table->string('provinces_id')->nullable();
            $table->foreign('provinces_id')->references('id')->on('provinces');
            $table->string('regency_id')->nullable();
            $table->foreign('regency_id')->references('id')->on('regencies');
            $table->string('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->bigInteger('village_id')->nullable();
            $table->text('alamat')->nullable();

            $table->integer('kas_tunai')->default(0);
            $table->integer('persediaan')->default(0);
            $table->integer('harga_tetap')->default(0);

            $table->integer('kw_bank')->default(0);
            $table->integer('kw_koperasi')->default(0);
            $table->integer('kw_lainnya')->default(0);

            $table->integer('kp_sertifikat')->default(0);
            $table->integer('kp_tidak_sertifikat')->default(0);

            $table->integer('om_1thn_lalu')->default(0);
            $table->integer('om_2thn_lalu')->default(0);

            $table->integer('lb_1thn_lalu')->default(0);
            $table->integer('lb_2thn_lalu')->default(0);

            $table->integer('laporan_regular')->default(0);

            $table->string('p1_nama_produk')->nullable();
            $table->text('p1_deskripsi')->nullable();
            $table->integer('p1_harga')->default(0);
            $table->string('p1_foto_produk')->nullable();

            $table->string('p2_nama_produk')->nullable();
            $table->text('p2_deskripsi')->nullable();
            $table->integer('p2_harga')->default(0);
            $table->string('p2_foto_produk')->nullable();

            $table->string('p3_nama_produk')->nullable();
            $table->text('p3_deskripsi')->nullable();
            $table->integer('p3_harga')->default(0);
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
