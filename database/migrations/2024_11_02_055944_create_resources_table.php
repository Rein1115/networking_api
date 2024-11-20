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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->unique(); // Unique code
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('mname')->nullable();
            $table->string('fullname')->nullable(); // Consider if this is necessary
            $table->integer('contact_no')->nullable(); // Consider using string if it might include non-numeric characters
            $table->string('email')->unique();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('companycode')->nullable();
            $table->integer('rolecode')->nullable();
            
            // Fields for the second contact person
            $table->string('h1_fname')->nullable();
            $table->string('h1_lname')->nullable();
            $table->string('h1_mname')->nullable();
            $table->string('h1_fullname')->nullable(); 
            $table->integer('h1_contact_no')->nullable();
            $table->string('h1_email')->nullable()->unique();
            $table->string('h1_address1')->nullable();
            $table->string('h1_address2')->nullable();
            $table->string('h1_city')->nullable();
            $table->string('h1_province')->nullable();
            $table->string('h1_postal_code')->nullable();
            $table->string('h1_companycode')->nullable();
            $table->integer('h1_rolecode')->nullable();
        
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
