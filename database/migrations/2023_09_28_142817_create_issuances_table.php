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
            $table->id(); //primary key
            
            $table->string('issuance_code')->unique();
            $table->decimal('total_value', 10, 2);
            $table->boolean('is_approved')->default(false);
            $table->uuid('issued_by_user_id');
            $table->uuid('issued_to_user_id');
            $table->unsignedBigInteger('issuance_type_id');
            $table->timestamp('issued_at');
            $table->timestamp('returned_at')->nullable();
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('issued_by_user_id')->references('id')->on('users');
            $table->foreign('issued_to_user_id')->references('id')->on('users');
            $table->foreign('issuance_type_id')->references('id')->on('issuance_types');
//asset_id to link the asset being issued   
            //user_id to associate the user receiving the asset
            //issued_at The date and time when the asset was issued.
            //returned_at The date and time when the asset was returned (nullable if the asset is still issued).
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