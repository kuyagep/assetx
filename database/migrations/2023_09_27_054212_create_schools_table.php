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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id');
            $table->unsignedBigInteger('district_id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('logo')->nullable();
            $table->string('slug')->nullable();
            $table->enum('status',[1,0])->default(1);

            $table->foreign('district_id')->references('id')->on('districts')->onDelete('RESTRICT');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};