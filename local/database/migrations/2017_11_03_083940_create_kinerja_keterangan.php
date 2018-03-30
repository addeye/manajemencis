<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKinerjaKeterangan extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('kinerja_keterangan', function (Blueprint $table) {
			$table->increments('id');
			$table->string('tahun');
			$table->integer('cis_lembaga_id')->unsigned();
			$table->foreign('cis_lembaga_id')->references('id')->on('cis_lembagas');
			$table->text('keterangan');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('kinerja_keterangan');
	}
}
