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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_number')->nullable();
            $table->string('get_started')->nullable();
            $table->string('alt_mode_procurement')->nullable();
            $table->uuid('user_id');
            $table->text('title')->nullable();
            $table->string('src_fund')->nullable();
            $table->double('amount', 15, 5);
            $table->string('attachment')->nullable();
            $table->enum('isApproved',['approved', 'pending', 'cancelled', 'rebid' ])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};