<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJumlahSasaranOnProkerPlutTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('proker_plut', function (Blueprint $table) {
			$table->integer('jumlah_sasaran');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('proker_plut', function (Blueprint $table) {
			$table->dropColumn('jumlah_sasaran');
		});
	}
}
