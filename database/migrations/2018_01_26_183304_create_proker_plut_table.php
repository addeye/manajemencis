<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProkerPlutTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('proker_plut', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('lembaga_id')->unsigned();
			$table->foreign('lembaga_id')->references('id')->on('cis_lembagas');
			$table->string('tahun');
			$table->string('kegiatan');
			$table->text('tujuan');
			$table->text('sasaran');
			$table->text('indikator');
			$table->text('output');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('proker_plut');
	}
}
