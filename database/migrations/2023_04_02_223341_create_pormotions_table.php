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
        Schema::create('pormotions', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name',55);
            $table->string('current_department',75);
            $table->string('current_designation',100);
            $table->string('current_salary',55);
            $table->string('promotion_new_salary',55);
            $table->string('promoted_department',100);
            $table->string('promoted_designation',100);
            $table->date('promotion_date');
            $table->text('description');
            $table->tinyInteger('created_by',11);
            $table->tinyInteger('updated_by',11)->nullable();
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
        Schema::dropIfExists('pormotions');
    }
};
