<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelaksanaanPendampingan extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('pelaksanaan_pendampingan', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('program_kerja_id')->unsigned()->nullable();
			$table->foreign('program_kerja_id')->references('id')->on('program_kerja')->onDelete('cascade');
			$table->date('tanggal');
			$table->string('materi');
			$table->text('tindak_lanjut');
			$table->integer('konsultan_id')->unsigned()->nullable();
			$table->foreign('konsultan_id')->references('id')->on('konsultans')->onDelete('cascade');
			$table->integer('lembaga_id')->unsigned()->nullable();
			$table->foreign('lembaga_id')->references('id')->on('cis_lembagas');
			$table->string('nama_kumkm');
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
		Schema::dropIfExists('pelaksanaan_pendampingan');
	}
}
