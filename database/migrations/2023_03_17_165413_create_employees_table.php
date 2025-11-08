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
        Schema::create('employees_primary_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('display_name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('marital_status');
            $table->string('date_of_married');
            $table->string('blood_group');
            $table->string('physically_handicapped');
            $table->date('date_of_joining');
            $table->string('profile_pic');
            $table->string('prefix');
            $table->string('job_title');
            $table->string('department');
            $table->string('reporting_to');
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
        Schema::dropIfExists('employees_primary_details');
    }
};
