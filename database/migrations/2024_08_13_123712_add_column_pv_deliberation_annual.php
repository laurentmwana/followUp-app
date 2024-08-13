<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('deliberations', function (Blueprint $table) {
            $table->text('pv')->nullable();
        });

        Schema::table('annuals', function (Blueprint $table) {
            $table->text('pv')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deliberations', function (Blueprint $table) {
            $table->dropColumn('pv');
        });
        Schema::table('annuals', function (Blueprint $table) {
            $table->dropColumn('pv');
        });
    }
};
