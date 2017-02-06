<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProkeridDetailidTableKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kegiatan_konsultans', function (Blueprint $table) {
            $table->integer('proker_id')->unsigned();
            $table->foreign('proker_id')->references('id')->on('proker_konsultans');
            $table->integer('detail_proker_id')->unsigned();
            $table->foreign('detail_proker_id')->references('id')->on('details_prokers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kegiatan_konsultans', function (Blueprint $table) {
            $table->dropColumn('proker_id');
            $table->dropColumn('detail_proker_id');
        });
    }
}
