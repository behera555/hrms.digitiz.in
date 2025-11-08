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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('requisition_id',100);
            $table->string('first_name',100);
            $table->string('last_name',100)->nullable();
            $table->string('source',100)->nullable();
            $table->string('referal_name',255);
            $table->string('email',255);
            $table->string('contact_number',25);
            $table->text('skill_set')->nullable();
            $table->string('resume',255);
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
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
        Schema::dropIfExists('candidates');
    }
};
