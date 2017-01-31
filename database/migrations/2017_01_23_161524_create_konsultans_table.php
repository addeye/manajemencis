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
            $table->string('username');
            $table->string('nama_lengkap');
            $table->string('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->text('alamat');
            $table->string('kode_pos');
            $table->string('jenis_kelamin',1);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('telepon');
            $table->string('email')->unique();
            $table->integer('pendidikan_id')->unsigned();
            $table->foreign('pendidikan_id')->references('id')->on('pendidikans');
            $table->string('perguruan_terkahir');
            $table->string('jurusan');
            $table->string('bidang_keahlian');
            $table->string('asosiasi');
            $table->text('pengalaman');
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
