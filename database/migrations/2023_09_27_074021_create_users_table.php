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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('position_id')->default('1');
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('address')->nullable();
            $table->enum('role',['super_admin','admin','client'])->default('client');
            $table->enum('status',['active','inactive'])->default('inactive');           
            
            $table->rememberToken();
            $table->timestamps();
            
            // Define the foreign key constraint
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('RESTRICT');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('RESTRICT');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};