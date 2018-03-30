<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanKonsultansBidang extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('kegiatan_konsultans_bidang', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('kegiatan_konsultan_id')->unsigned();
			$table->foreign('kegiatan_konsultan_id')->references('id')->on('kegiatan_konsultans')->onDelete('cascade');
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
	public function down() {
		Schema::dropIfExists('kegiatan_konsultans_bidang');
	}
}
