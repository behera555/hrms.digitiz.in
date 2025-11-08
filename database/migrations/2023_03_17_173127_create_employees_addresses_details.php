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
        Schema::create('employees_addresses_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->text('current_address_line_one');
            $table->text('current_address_line_two');
            $table->text('permanent_address_line_one');
            $table->text('permanent_address_line_two');
            $table->string('current_address_city');
            $table->string('permanent_address_city');
            $table->string('current_address_state');
            $table->string('permanent_address_state');
            $table->string('current_address_country');
            $table->string('permanent_address_country');
            $table->string('current_address_pincode');
            $table->string('permanent_address_pincode');
            $table->string('same_as_current_address');
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
        Schema::dropIfExists('employees_addresses_details');
    }
};
