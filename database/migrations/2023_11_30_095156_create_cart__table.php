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
        Schema::create('cart_', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mobileUser_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('price');
            $table->integer('quantity');
            $table->foreign('mobileUser_id')->references('id')->on('mobile_user')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_');
    }
};
