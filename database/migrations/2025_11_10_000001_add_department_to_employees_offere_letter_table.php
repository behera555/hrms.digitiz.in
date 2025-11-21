<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employees_offere_letter', function (Blueprint $table) {
            if (!Schema::hasColumn('employees_offere_letter', 'department')) {
                $table->string('department')->nullable()->after('job_title');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees_offere_letter', function (Blueprint $table) {
            if (Schema::hasColumn('employees_offere_letter', 'department')) {
                $table->dropColumn('department');
            }
        });
    }
};