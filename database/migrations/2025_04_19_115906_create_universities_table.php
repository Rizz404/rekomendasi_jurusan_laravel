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
        Schema::create('universities', function (Blueprint $table)
        {
            $table->id();
            $table->string('name', 150);
            $table->enum('status', ['negeri', 'swasta']);
            $table->string('city', 100);
            $table->string('province', 100);
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_id')->nullable();
            $table->decimal('rating', 3, 2)->default(0); // Rating kampus (0-5)
            $table->boolean('is_active')->default(true);
            $table->timestamps();


            $table->index('name');
            $table->index('city');
            $table->index('status');
        });

        // Tabel pivot untuk hubungan many-to-many
        Schema::create('college_major_university', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('college_major_id')->constrained()->onDelete('cascade');
            $table->foreignId('university_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['college_major_id', 'university_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_major_university');
        Schema::dropIfExists('universities');
    }
};
