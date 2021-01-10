<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('participant', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamps('deleted_at')->nullable();
            $table->string('image');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedBigInteger('provinsi_id');
            $table->foreign('provinsi_id')->references('id')->on('provinsi')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('kabupaten_kota_id');
            $table->foreign('kabupaten_kota_id')->references('id')->on('kabupaten_kota')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('kecamatan_id');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('kelurahan_id');
            $table->foreign('kelurahan_id')->references('id')->on('kelurahan')
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
        Schema::dropIfExists('participant');
    }
}
