<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKonsultansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsultans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('no_registrasi');
            $table->string('nama_lengkap');
            $table->string('provinces_id');
            $table->foreign('provinces_id')->references('id')->on('provinces');
            $table->string('regency_id');
            $table->foreign('regency_id')->references('id')->on('regencies');
            $table->text('alamat');
            $table->string('kode_pos');
            $table->string('jenis_kelamin',1);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('telepon');
            $table->string('email')->unique();

            $table->integer('pendidikan_id')->unsigned();
            $table->foreign('pendidikan_id')->references('id')->on('pendidikans');

            $table->string('perguruan_terakhir');
            $table->string('jurusan');
            $table->string('bidang_keahlian');
            $table->text('pengalaman');
            $table->text('sertifikat');
            $table->string('asosiasi');
            $table->integer('lembaga_id')->unsigned();
            $table->foreign('lembaga_id')->references('id')->on('lembagas');
            $table->integer('bidang_layanan_id')->unsigned();
            $table->foreign('bidang_layanan_id')->references('id')->on('bidang_layanans');
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
        Schema::dropIfExists('konsultans');
    }
}
