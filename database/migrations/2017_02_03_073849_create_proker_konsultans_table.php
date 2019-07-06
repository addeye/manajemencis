<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProkerKonsultansTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('proker_konsultans', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('konsultan_id')->unsigned()->nullable();
			$table->foreign('konsultan_id')->references('id')->on('konsultans');
			$table->string('tahun_kegiatan');
			$table->string('program');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('proker_konsultans');
	}
}
