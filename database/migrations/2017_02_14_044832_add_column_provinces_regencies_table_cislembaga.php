<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProvincesRegenciesTableCislembaga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cis_lembagas', function (Blueprint $table) {
            $table->string('provinces_id')->nullable();
            $table->foreign('provinces_id')->references('id')->on('provinces');
            $table->string('regency_id')->nullable();
            $table->foreign('regency_id')->references('id')->on('regencies');
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
            $table->dropColumn('provinces_id');
            $table->dropColumn('regency_id');
        });
    }
}
