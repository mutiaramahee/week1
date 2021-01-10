<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKabupatenKotaIdToKecamatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::table('kecamatan', function (Blueprint $table) {
            $table->unsignedBigInteger('kabupaten_kota_id')->nullable();
            $table->foreign('kabupaten_kota_id')->references('id')->on('kabupaten_kota')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('kecamatan', 'kabupaten_kota_id')){
            Schema::table('kecamatan', function (Blueprint $table)
            {
                $table->dropColumn('kabupaten_kota_id');
            });
        }
    }
}
