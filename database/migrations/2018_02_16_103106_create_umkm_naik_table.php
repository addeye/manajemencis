<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmkmNaikTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('kumkm_naik', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('kumkm_id')->unsigned();
			$table->foreign('kumkm_id')->references('id')->on('kumkm')->onDelete('cascade');
			$table->integer('lembaga_id')->unsigned();
			$table->foreign('lembaga_id')->references('id')->on('cis_lembagas');
			$table->integer('konsultan_id')->unsigned();
			$table->foreign('konsultan_id')->references('id')->on('konsultans');
			$table->string('tahun');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('kumkm_naik');
	}
}
