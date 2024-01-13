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
        
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id');
            $table->string('purchase_order_number');            
            $table->unsignedBigInteger('supplier_id');
            $table->double('amount', 15, 5);
            $table->string('attachment')->nullable();
            $table->enum('category',['catering-services','catering-services-venue', 'goods-services', 'furniture-fixtures', 'rentals', 'others' ])->default('others');
            $table->enum('status',['approved', 'delivered', 'not-delivered', 'pending', 'failed','processing','for-payment' ])->default('pending');
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('RESTRICT');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('RESTRICT');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};