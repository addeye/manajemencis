<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmkmProsesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('kumkm_proses', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('kumkm_naik_id')->unsigned();
			$table->foreign('kumkm_naik_id')->references('id')->on('kumkm_naik')->onDelete('cascade');
			$table->date('tanggal_proses');
			$table->integer('bidang_layanan_id')->unsigned()->nullable();
			$table->foreign('bidang_layanan_id')->references('id')->on('bidang_layanans');
			$table->text('permasalahan');
			$table->text('solusi');
			$table->text('keterangan')->nullable();
			$table->integer('nilai')->nullable(); //1,2,3,4,5
			$table->date('tanggal_nilai')->nullable();
			$table->integer('konsultan_id')->unsigned();
			$table->foreign('konsultan_id')->references('id')->on('konsultans');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('kumkm_proses');
	}
}
