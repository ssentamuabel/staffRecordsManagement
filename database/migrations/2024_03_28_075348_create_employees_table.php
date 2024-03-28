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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table ->string('sur_name', 100);
            $table->string('first_name', 100);
            $table->string('other_names', 100);
            $table->date('dob');
            $table->enum('gender', ['Male', 'Female']);
            $table->boolean('Married')->deafult(false);
            $table->string('email');
            $table->string('nationality')->default('Ugandan');
            $table->string('nin_number');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
