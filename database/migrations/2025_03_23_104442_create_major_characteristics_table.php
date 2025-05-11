<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('major_characteristics', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('college_major_id')->constrained('college_majors')->onDelete('cascade');
            $table->foreignId('criteria_id')->constrained('criterias')->onDelete('cascade');
            $table->decimal('compatibility_weight', 5, 2);
            $table->decimal('minimum_score', 5, 2)->nullable();
            $table->timestamps();


            $table->unique(['college_major_id', 'criteria_id']);
        });

        // * Validasi di table
        DB::statement('ALTER TABLE major_characteristics ADD CONSTRAINT check_compatibility_weight CHECK (compatibility_weight >= 0 AND compatibility_weight <= 1)');
        DB::statement('ALTER TABLE major_characteristics ADD CONSTRAINT check_minimum_score CHECK (minimum_score IS NULL OR (minimum_score >= 0 AND minimum_score <= 100))');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('major_characteristics');
    }
};
