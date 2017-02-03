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
            $table->string('idlembaga',10);
            $table->string('name');
            $table->integer('tingkat_id')->unsigned();
            $table->foreign('tingkat_id')->references('id')->on('tingkats');
            $table->string('provinces_id');
            $table->foreign('provinces_id')->references('id')->on('provinces');
            $table->string('regency_id');
            $table->foreign('regency_id')->references('id')->on('regencies');
            $table->text('alamat');
            $table->string('kode_pos');
            $table->string('bentuk_lembaga');
            $table->string('SKPD');
            $table->string('tahun_berdiri');
            $table->string('telepon');
            $table->string('email');
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
        Schema::dropIfExists('lembagas');
    }
}
