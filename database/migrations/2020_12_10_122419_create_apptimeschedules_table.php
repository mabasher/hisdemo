<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApptimeschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apptimeschedules', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_no');
            $table->integer('sch_dayid');
            $table->renameColumn('from', 'to');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('entered_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('duty_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apptimeschedules');
    }
}
