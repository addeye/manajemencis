<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnFileTableKonsultan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('konsultans', function (Blueprint $table) {
            $table->string('ijazah');
            $table->string('sertifikat_1');
            $table->string('sertifikat_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('konsultans', function (Blueprint $table) {
            $table->dropColumn('ijazah');
            $table->dropColumn('sertifikat_1');
            $table->dropColumn('sertifikat_2');
        });
    }
}
