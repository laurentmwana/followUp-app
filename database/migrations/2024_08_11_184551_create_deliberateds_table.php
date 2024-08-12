<?php

use App\Models\Student;
use App\Models\Decision;
use App\Models\Deliberation;
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
        Schema::create('deliberateds', function (Blueprint $table) {
            $table->id();
            $table->float('pourcent');
            $table->float('mca')->default(0);
            $table->float('mcb')->default(0);
            $table->float('mab')->default(0);
            $table->float('total');
            $table->float('tn');
            $table->integer('ncc')->default(0);
            $table->integer('tncc')->default(0);
            $table->float('tnp');
            $table->foreignIdFor(Deliberation::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignIdFor(Student::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->enum('validated', ['NV', 'V'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliberateds');
    }
};
