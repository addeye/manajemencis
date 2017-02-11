<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCisLembagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cis_lembagas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plut_name');
            $table->string('plut_bentuk_kelembagaan');
            $table->text('plut_alamat');
            $table->string('plut_telp');
            $table->string('plut_email');
            $table->string('plut_whatsapp');
            $table->string('plut_website');
            $table->string('plut_facebook');
            $table->string('skpd_name');
            $table->text('skpd_alamat');
            $table->string('skpd_telp');
            $table->string('skpd_email');
            $table->string('skpd_whatsapp');
            $table->string('tahun_perolehan');
            $table->string('mulai_operasional');
            $table->string('tgl_peresmian');
            $table->string('diresmikan_oleh');
            $table->string('hibah_tahun');
            $table->text('ket_bersinergi');
            $table->string('produk_unggulan');
            $table->string('pemasaran');
            $table->text('produk_potensial');
            $table->string('jml_umkm_ecommarce');
            $table->string('jml_produk_online');
            $table->string('photo_gedung');
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
        Schema::dropIfExists('cis_lembagas');
    }
}
