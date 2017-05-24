<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIdlembagaTableCislembaga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cis_lembagas', function (Blueprint $table) {
            $table->string('id_lembaga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cis_lembagas', function (Blueprint $table) {
            $table->dropColumn('id_lembaga');
        });
    }
}
