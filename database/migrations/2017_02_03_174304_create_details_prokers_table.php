<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsProkersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('details_prokers', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('proker_id')->unsigned();
			$table->foreign('proker_id')->references('id')->on('proker_konsultans');
			$table->string('jenis_kegiatan');
			$table->text('tujuan');
			$table->text('sasaran');
			$table->text('indikator');
			$table->integer('jenis_layanan_id')->unsigned()->nullable();
			$table->foreign('jenis_layanan_id')->references('id')->on('jenis_layanans');
			$table->integer('output')->nullable();
			$table->string('ket_output');
			$table->integer('jml_penerima');
			$table->integer('anggaran')->nullable();
			$table->text('jadwal_pelaksana');
			$table->string('mitra_kerja');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('details_prokers');
	}
}
