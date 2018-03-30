<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoperasiDetailTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('koperasi_detail', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('koperasi_id')->unsigned()->nullable();
			$table->foreign('koperasi_id')->references('id')->on('koperasi')->onDelete('cascade');
			$table->date('tgl_rat_tahun_buku')->nullable();
			$table->integer('jml_anggota')->nullable();
			$table->integer('jml_karyawan')->nullable();
			$table->integer('jml_asset')->nullable();
			$table->integer('jml_modal_sendiri')->nullable();
			$table->integer('jml_modal_luar')->nullable();
			$table->integer('volume_usaha')->nullable();
			$table->integer('sisa_hasil')->nullable();
			$table->text('kegiatan_usaha')->nullable();
			$table->date('tanggal_keadaan');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('koperasi_detail');
	}
}
