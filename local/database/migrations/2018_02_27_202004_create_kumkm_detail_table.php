<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKumkmDetailTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('kumkm_detail', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('kumkm_id')->unsigned()->nullable();
			$table->foreign('kumkm_id')->references('id')->on('kumkm')->onDelete('cascade');
			$table->integer('jml_tenaga_kerja')->nullable();
			$table->integer('modal_sendiri')->nullable();
			$table->integer('modal_hutang')->nullable();
			$table->integer('asset')->nullable();
			$table->integer('omset');
			$table->text('kegiatan_usaha')->nullable();
			$table->date('tanggal_keadaan');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('kumkm_detail');
	}
}
