<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participant', function (Blueprint $table)
        {
            $table->string('image')->nullable()->change();
            $table->unsignedBigInteger('provinsi_id')->nullable()->change();
            $table->unsignedBigInteger('kabupaten_kota_id')->nullable()->change();
            $table->unsignedBigInteger('kecamatan_id')->nullable()->change();
            $table->unsignedBigInteger('kelurahan_id')->nullable()->change();      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
