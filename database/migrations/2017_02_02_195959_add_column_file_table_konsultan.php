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
            $table->string('ijazah')->nullable();
            $table->string('sertifikat_1')->nullable();
            $table->string('sertifikat_2')->nullable();
            $table->string('scan_ktp')->nullable();
            $table->string('pas_photo')->nullable();
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
            $table->dropColumn('scan_ktp');
            $table->dropColumn('pas_photo');
        });
    }
}
