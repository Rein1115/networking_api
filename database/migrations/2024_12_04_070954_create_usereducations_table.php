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
        Schema::create('usereducations', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->nullable(); // Unique code for the education record
            $table->integer('transNo')->nullable(); // Transaction number
            $table->string('highest_education')->nullable(); // Highest level of education
            $table->string('school_name')->nullable(); // Name of the school
            $table->year('year_entry')->nullable(); // Year of entry (uses YEAR type)
            $table->year('year_end')->nullable(); // Year of completion (uses YEAR type)
            $table->string('status')->nullable(); // Education status (e.g., completed, ongoing)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usereducations');
    }
};
