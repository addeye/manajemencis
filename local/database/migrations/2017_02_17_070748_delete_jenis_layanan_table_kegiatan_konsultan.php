<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteJenisLayananTableKegiatanKonsultan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kegiatan_konsultans', function (Blueprint $table) {
            $table->dropForeign('kegiatan_konsultans_jenis_layanan_id_foreign');
            $table->dropColumn('jenis_layanan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
