<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnDeletedAtOnParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('participant', 'deleted_at')){
            Schema::table('participant', function (Blueprint $table)
            {
                $table->dropColumn('deleted_at');
            }); 
                $table->softDeletes()->after('updated_at');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('participant', 'deleted_at')){
            Schema::table('participant', function (Blueprint $table)
            {
                $table->softDeletes()->after('updated_at');
            });
        }
    }
}
