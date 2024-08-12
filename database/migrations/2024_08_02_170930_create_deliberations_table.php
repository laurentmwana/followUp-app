<?php

use App\Models\Level;
use App\Models\Year;
use App\Models\Student;
use App\Models\Semester;
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
        Schema::create('deliberations', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Semester::class)->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(Level::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(Year::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliberations');
    }
};
