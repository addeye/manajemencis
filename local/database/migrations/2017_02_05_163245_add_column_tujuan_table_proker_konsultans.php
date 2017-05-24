<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTujuanTableProkerKonsultans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proker_konsultans', function (Blueprint $table) {
            $table->string('tujuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proker_konsultans', function (Blueprint $table) {
            $table->dropColumn('tujuan');
        });
    }
}
