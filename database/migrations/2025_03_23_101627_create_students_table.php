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
        Schema::create('students', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('user_id')->after('id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('NIS', 20)->unique()->nullable();
            $table->string('name', 100)->nullable();
            $table->enum('gender', ['man', 'woman'])->nullable();
            $table->string('school_origin', 100)->nullable();
            $table->enum('school_type', ['high_school', 'vocational_school'])->nullable();
            $table->string('school_major', 100)->nullable();
            $table->integer('graduation_year')->nullable();
            // * Ini tuh otomatis ada created_at dan updated_at
            $table->timestamps();
            $table->softDeletes(); // * Tambahin deleted at

            $table->index('name');
            $table->index('school_type');
            $table->index('graduation_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
