<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpappointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opappointments', function (Blueprint $table) {
            $table->id();
            $table->string('appoint_no');
            $table->datetime('app_date');
            $table->string('app_type')->nullable();
            $table->string('reg_no');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('doctor_no');
            $table->string('ful_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('salutation_id')->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile')->unique();
            $table->string('email')->unique();
            $table->string('national_id')->nullable();
            $table->string('religion_no')->nullable();
            $table->string('entered')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('active_status')->nullable();
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
        Schema::dropIfExists('opappointments');
    }
}
