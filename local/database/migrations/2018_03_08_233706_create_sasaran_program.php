<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSasaranProgram extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('sasaran_program', function (Blueprint $table) {
			$table->increments('id');
			$table->string('tahun')->nullable();
			$table->date('tgl_keadaan')->nullable();
			$table->integer('lembaga_id')->unsigned()->nullable();
			$table->foreign('lembaga_id')->references('id')->on('cis_lembagas');
			$table->integer('ukmtable_id');
			$table->string('ukmtable_type');
			$table->string('lock', 5)->default('No');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('sasaran_program');
	}
}
