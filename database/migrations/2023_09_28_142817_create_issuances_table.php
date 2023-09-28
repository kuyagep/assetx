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
        Schema::create('issuances', function (Blueprint $table) {
            $table->id();
            $table->string('issuance_code')->unique();
            $table->decimal('total_value', 10, 2);
            $table->boolean('is_approved')->default(false);
            $table->uuid('received_form_user_id');
            $table->uuid('received_by_user_id');
            $table->unsignedBigInteger('issuance_type_id');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('received_form_user_id')->references('id')->on('users');
            $table->foreign('received_by_user_id')->references('id')->on('users');
            $table->foreign('issuance_type_id')->references('id')->on('issuance_type');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issuances');
    }
};