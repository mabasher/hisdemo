<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('reg_no');
            $table->string('reg_type')->nullable();
            $table->datetime('reg_date');
            $table->string('ful_name');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender');
            $table->string('salutation_id')->nullable();
            $table->date('dob');
            $table->string('mobile')->unique();
            $table->string('home_phone')->unique();
            $table->string('email')->unique();
            $table->string('email2')->unique();
            $table->string('national_id')->nullable();
            $table->string('religion_no')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('pre_address')->nullable();
            $table->string('pre_thana')->nullable();
            $table->string('pre_district')->nullable();
            $table->string('pre_division')->nullable();
            $table->string('pre_country')->nullable();
            $table->string('pre_postoffice')->nullable();
            $table->string('per_address')->nullable();
            $table->string('per_thana')->nullable();
            $table->string('per_district')->nullable();
            $table->string('per_division')->nullable();
            $table->string('per_country')->nullable();
            $table->string('per_postoffice')->nullable();
            $table->string('em_contact_person')->nullable();
            $table->string('em_relation')->nullable();
            $table->string('em_contact_no')->nullable();
            $table->string('em_address')->nullable();
            $table->string('entered_by')->nullable();
            $table->datetime('entry_timestamp')->nullable();
            $table->string('updated_by')->nullable();
            $table->datetime('update_timestamp')->nullable();
            $table->string('cancel_by')->nullable();
            $table->datetime('cancel_timestamp')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_password')->nullable();
            $table->string('company_no')->nullable();
            $table->string('token_no')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->string('img_url')->nullable();
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
        Schema::dropIfExists('registrations');
    }
}
