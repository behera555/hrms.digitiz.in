<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_documents_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('driving_license_license_number');
            $table->string('driving_license_date_of_birth');
            $table->string('driving_license_name');
            $table->string('driving_license_father_name');
            $table->string('driving_license_expires_on');
            $table->string('driving_license_attachment');
            $table->string('pan_card_permanent_account_number');
            $table->string('pan_card_date_of_birth');
            $table->string('pan_card_name');
            $table->string('pan_card_parent_name');
            $table->string('pan_card_attachment');
            $table->string('passport_passport_number');
            $table->string('passport_date_of_birth');
            $table->string('passport_full_name');
            $table->string('passport_father_name');
            $table->string('passport_date_of_issue');
            $table->string('passport_place_of_issue');
            $table->string('passport_place_of_birth');
            $table->string('passport_expires_on');
            $table->string('passport_address');
            $table->string('passport_attachment');
            $table->string('aadhaar_number');
            $table->string('aadhaar_date_of_birth');
            $table->string('aadhaar_name');
            $table->string('aadhaar_father_name');
            $table->string('aadhaar_address');
            $table->string('aadhaar_attachment');
            $table->string('voter_id_number');
            $table->string('voter_id_date_of_birth');
            $table->string('voter_id_name');
            $table->string('voter_id_father_name');
            $table->string('voter_id_attachment');
            $table->index(['emp_id']);
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
        Schema::dropIfExists('employees_documents_details');
    }
};
