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
        Schema::create('college_majors', function (Blueprint $table)
        {
            $table->id();
            $table->string('major_name', 100);
            $table->string('faculty', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('field_of_study', 100)->nullable();
            $table->text('career_prospects')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_majors');
    }
};
