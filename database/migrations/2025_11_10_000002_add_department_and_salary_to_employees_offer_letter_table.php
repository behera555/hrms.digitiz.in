<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('employees_offer_letter', function (Blueprint $table) {
            if (!Schema::hasColumn('employees_offer_letter', 'department')) {
                $table->string('department')->nullable()->after('designation');
            }
        });
    }

    public function down(): void
    {
        Schema::table('employees_offer_letter', function (Blueprint $table) {
            if (Schema::hasColumn('employees_offer_letter', 'department')) {
                $table->dropColumn('department');
            }
        });
    }
};