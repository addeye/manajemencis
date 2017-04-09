<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIdLembagaTabelProdukUnggulan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_unggulan', function (Blueprint $table) {
            $table->integer('lembaga_id')->unsigned();
            $table->foreign('lembaga_id')->references('id')->on('cis_lembagas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk_unggulan', function (Blueprint $table) {
            $table->dropColumn('lembaga_id');
        });
    }
}
