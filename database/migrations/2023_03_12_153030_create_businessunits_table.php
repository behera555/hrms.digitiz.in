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
        Schema::create('businessunits', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name',100);
            $table->string('organization_started_on',50);
            $table->string('primary_phone_number',25);
            $table->string('secondary_phone_number',25);
            $table->string('fax_number',25);
            $table->string('country',50);
            $table->string('state',50);
            $table->string('city',50);
            $table->string('currency',50);
            $table->text('address');
            $table->text('org_logo');
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
        Schema::dropIfExists('businessunits');
    }
};
