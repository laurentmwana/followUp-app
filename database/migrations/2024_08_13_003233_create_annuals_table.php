<?php

use App\Models\Year;
use App\Models\Level;
use App\Models\Annual;
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
        Schema::create('annuals', function (Blueprint $table) {
            $table->id();
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

        Schema::table('deliberateds', function (Blueprint $table) {
            $table->foreignIdFor(Annual::class)
                ->nullable()
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
        Schema::table('deliberateds', function (Blueprint $table) {
            $table->dropForeignIdFor(Annual::class);
        });
        Schema::dropIfExists('annuals');
    }
};
