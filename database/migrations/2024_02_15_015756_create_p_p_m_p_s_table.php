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
        Schema::create('p_p_m_p_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('attachment')->nullable();
            $table->double('amount', 15, 5);            
            $table->string('remarks')->nullable();
            $table->enum('status',['pending','reject','approved'])->default('pending');
            $table->timestamps();

            $table->foreign('school_id')->references('id')->on('schools')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_p_m_p_s');
    }
};