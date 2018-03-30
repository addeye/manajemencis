<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanKonsultanFile extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('kegiatan_konsultan_file', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('kegiatan_konsultan_id')->unsigned();
			$table->foreign('kegiatan_konsultan_id')->references('id')->on('kegiatan_konsultans');
			$table->string('filename');
			$table->string('path');
			$table->string('type');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('kegiatan_konsultan_file');
	}
}
