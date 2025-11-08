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
        Schema::create('employees_contact_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('working_email');
            $table->string('working_phone');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('residence_phone');
            $table->string('skype_id');
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
        Schema::dropIfExists('employees_contact_details');
    }
};
