<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameApptimescheduleColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apptimeschedules', function (Blueprint $table) {
            $table->renameColumn('sch_dayid', 'appdayschedule_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apptimeschedules', function (Blueprint $table) {
            $table->renameColumn('appdayschedule_id', 'sch_dayid');
        });
    }
}
