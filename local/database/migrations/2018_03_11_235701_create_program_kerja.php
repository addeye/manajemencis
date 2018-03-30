<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramKerja extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('program_kerja', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('sasaran_program_id')->unsigned()->nullable();
			$table->foreign('sasaran_program_id')->references('id')->on('sasaran_program')->onDelete('cascade');
			$table->integer('bidang_layanan_id')->unsigned()->nullable();
			$table->foreign('bidang_layanan_id')->references('id')->on('bidang_layanans');
			$table->text('permasalahan');
			$table->string('proker_pendampingan');
			$table->string('tahun');
			$table->string('target_capaian');
			$table->string('nama_konsultan');
			$table->integer('lembaga_id')->unsigned()->nullable();
			$table->foreign('lembaga_id')->references('id')->on('cis_lembagas');
			$table->string('lock')->default('No');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('program_kerja');
	}
}
