<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFewColumnOnProkerKonsultan extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('proker_konsultans', function (Blueprint $table) {
			$table->integer('lembaga_id')->unsigned()->nullable();
			$table->foreign('lembaga_id')->references('id')->on('cis_lembagas');
			$table->text('sasaran')->nullable();
			$table->integer('jumlah_sasaran')->nullable();
			$table->text('indikator')->nullable();
			$table->text('output')->nullable();
			$table->string('status_lock', 5)->default('No');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('proker_konsultans', function (Blueprint $table) {
			$table->dropForeign(['lembaga_id']);
			$table->dropColumn('lembaga_id');
			$table->dropColumn('sasaran');
			$table->dropColumn('jumlah_sasaran');
			$table->dropColumn('indikator');
			$table->dropColumn('output');
			$table->dropColumn('status_lock');
		});
	}
}
