<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppdayschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appdayschedules', function (Blueprint $table) {
            $table->id();
            $table->datetime('sch_date');
            $table->string('doctor_no');
            $table->integer('block_load')->nullable();
            $table->integer('avg_duration')->nullable();
            $table->datetime('sch_start_time')->nullable();
            $table->datetime('sch_end_time')->nullable();
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
        Schema::dropIfExists('appdayschedules');
    }
}
