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
        Schema::create('saw_results', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('college_major_id')->constrained('college_majors')->onDelete('cascade');
            $table->decimal('final_score', 10, 4);
            $table->integer('rank')->nullable();
            $table->text('recommendation_reason')->nullable();
            $table->timestamp('calculation_date')->useCurrent();
            $table->timestamps();


            $table->unique(['student_id', 'college_major_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saw_results');
    }
};
