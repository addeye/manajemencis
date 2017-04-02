<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBidangUsahaIdTableProdukUnggulan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_unggulan', function (Blueprint $table) {
            $table->integer('bidang_usaha')->unsigned()->nullable()->change();
            $table->foreign('bidang_usaha')->references('id')->on('bidang_usahas');
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
