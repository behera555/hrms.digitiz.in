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
        Schema::create('employees_education_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('degree');
            $table->string('specialization');
            $table->string('year_of_joining');
            $table->string('year_of_completion');
            $table->string('cgpa');
            $table->string('college');
            $table->string('attachment');
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
        Schema::dropIfExists('employees_education_details');
    }
};
