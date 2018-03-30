<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKonsultanIdOnDetailsProker extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('details_prokers', function (Blueprint $table) {
			$table->integer('konsultan_id')->unsigned()->nullable();
			$table->foreign('konsultan_id')->references('id')->on('konsultans');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('details_prokers', function (Blueprint $table) {
			$table->dropForeign(['konsultan_id']);
			$table->dropColumn('konsultan_id');
		});
	}
}
