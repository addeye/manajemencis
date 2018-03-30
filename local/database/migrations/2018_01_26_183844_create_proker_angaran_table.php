<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProkerAngaranTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('proker_anggaran', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('proker_konsultans_id')->unsigned();
			$table->foreign('proker_konsultans_id')->references('id')->on('proker_konsultans');
			$table->integer('anggaran_id')->unsigned();
			$table->foreign('anggaran_id')->references('id')->on('anggaran');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('proker_anggaran');
	}
}
