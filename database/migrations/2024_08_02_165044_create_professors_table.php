<?php

use App\Models\Professor;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('firstname');
            $table->string('phone')->unique();
            $table->char('sex');
            $table->timestamps();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->foreignIdFor(Professor::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeignIdFor(Professor::class);
        });

        Schema::dropIfExists('professors');
    }
};
