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
        Schema::create('recruitment', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('requisition_code');
            $table->string('job_title');
            $table->string('position');
            $table->integer('no_of_positions');
            $table->text('job_description');
            $table->text('required_skills');
            $table->string('required_qualification');
            $table->string('required_experience_range');
            $table->string('employment_status');
            $table->string('priority');
            $table->string('due_date');
            $table->string('recruitment_status');
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruitment');
    }
};
