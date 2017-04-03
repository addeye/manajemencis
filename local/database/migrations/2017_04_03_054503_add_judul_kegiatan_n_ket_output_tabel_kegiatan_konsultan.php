<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJudulKegiatanNKetOutputTabelKegiatanKonsultan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kegiatan_konsultans', function (Blueprint $table) {
            $table->string('judul_kegiatan');
            $table->string('ket_output');
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
            $table->dropColumn('judul_kegiatan');
            $table->dropColumn('ket_output');
        });
    }
}
