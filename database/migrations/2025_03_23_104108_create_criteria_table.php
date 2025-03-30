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
        Schema::create('criterias', function (Blueprint $table)
        {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->decimal('weight', 5, 2);
            $table->enum('type', ['benefit', 'cost']);
            $table->enum('school_type', ['SMA', 'SMK', 'All']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};
