<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBidangLayananIdOnProkerKonsultanTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('proker_konsultans', function (Blueprint $table) {
			$table->integer('bidang_layanan_id')->unsigned()->nullable();
			$table->foreign('bidang_layanan_id')->references('id')->on('bidang_layanans');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('proker_konsultans', function (Blueprint $table) {
			$table->dropColumn('bidang_layanan_id');
		});
	}
}
