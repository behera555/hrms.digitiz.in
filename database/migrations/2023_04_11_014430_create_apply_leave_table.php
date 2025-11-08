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
        Schema::create('apply_leave', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id',11);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('day_type',55)->nullable();
            $table->string('leave_balance',55);
            $table->text('reason');
            $table->string('leave_status',55)->nullable();
            $table->text('leave_status_reason')->nullable();
            $table->index(['emp_id']);
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
        Schema::dropIfExists('apply_leave');
    }
};
