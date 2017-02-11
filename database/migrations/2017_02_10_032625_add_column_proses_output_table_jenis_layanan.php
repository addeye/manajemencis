<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProsesOutputTableJenisLayanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenis_layanans', function (Blueprint $table) {
            $table->string('proses_or_output'); //proses & output
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenis_layanans', function (Blueprint $table) {
            $table->dropColumn('proses_or_output'); //proses & output
        });
    }
}
