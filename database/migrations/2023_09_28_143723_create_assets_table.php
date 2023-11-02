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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('article');
            $table->string('description');
            $table->string('reference')->nullable();
            $table->string('property_no');
            $table->string('unit_of_measure');
            $table->decimal('unit_value', 10, 2);
            $table->integer('balance_per_card_qty');
            $table->decimal('balance_per_card_value', 10, 2);
            $table->integer('onhand_per_count_qty');
            $table->decimal('onhand_per_count_value', 10, 2);
            $table->integer('shortage_overage_qty')->nullable();
            $table->decimal('shortage_overage_value', 10, 2)->nullable();
            $table->date('date_acquired');
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('classification_id'); //classifications
            $table->unsignedBigInteger('status_id')->default(1); //asset status
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('classification_id')->references('id')->on('asset_classifications');
            $table->foreign('status_id')->references('id')->on('asset_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};