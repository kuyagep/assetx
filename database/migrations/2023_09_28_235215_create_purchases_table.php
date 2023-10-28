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
            $table->string('purchase_number');
            $table->string('get_started');
            $table->string('alt_mode_procurement');
            $table->unsignedBigInteger('office_id');
            $table->uuid('user_id');
            $table->text('title');
            $table->string('src_fund');
            $table->double('amount', 15, 5);
            $table->string('attachment');
            $table->enum('isApproved',['approved', 'pending', 'cancelled', 'rebid' ])->default('pending');
            $table->timestamps();

            $table->foreign('office_id')->references('id')->on('offices')->onDelete('RESTRICT');
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