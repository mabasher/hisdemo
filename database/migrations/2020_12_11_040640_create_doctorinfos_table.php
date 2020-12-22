<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctorinfos', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_no')->unique();;
            $table->string('doctor_name');
            $table->string('qualification')->nullable();
            $table->string('designation')->nullable();
            $table->string('doc_chember');
            $table->string('contact_no')->unique();
            $table->string('email')->nullable();
            $table->integer('specialization_no')->nullable();
            $table->integer('job_id')->nullable();
            $table->string('gender');
            $table->string('special_interest')->nullable();
            $table->string('doctor_type')->nullable();
            $table->string('dept_no');
            $table->string('user_name')->nullable();
            $table->string('user_psw')->nullable();
            $table->string('entered_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('doctor_image')->nullable();
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
        Schema::dropIfExists('doctorinfos');
    }
}
