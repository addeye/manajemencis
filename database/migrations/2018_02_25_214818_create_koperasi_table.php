<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoperasiTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('koperasi', function (Blueprint $table) {
			$table->increments('id');
			$table->string('id_koperasi')->unique();
			$table->string('nama_koperasi');
			$table->string('regency_id')->nullable();
			$table->foreign('regency_id')->references('id')->on('regencies');
			$table->text('alamat')->nullable();
			$table->string('nomor_badan_hukum')->nullable();
			$table->date('tgl_badan_hukum')->nullable();
			$table->string('jenis_koperasi')->nullable();
			$table->integer('lembaga_id')->unsigned()->nullable();
			$table->foreign('lembaga_id')->references('id')->on('cis_lembagas');
			$table->string('konsultan');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('koperasi');
	}
}
