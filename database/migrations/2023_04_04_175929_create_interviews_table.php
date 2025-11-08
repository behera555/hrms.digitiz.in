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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->string('requisition_id',100);
            $table->string('candidate_name',150);
            $table->string('interview_status',100)->nullable();
            $table->string('interviewer',100)->nullable();
            $table->string('interview_type',55);
            $table->string('interview_date',25);
            $table->string('interview_time',25);
            $table->string('interview_name',100);
            $table->text('interview_link')->nullable();
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
        Schema::dropIfExists('interviews');
    }
};
