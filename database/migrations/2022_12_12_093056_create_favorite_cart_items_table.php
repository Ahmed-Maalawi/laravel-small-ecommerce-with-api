<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_item_id')->references('id')->on('product_items')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('cart_id')->references('id')->on('favorite_carts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_cart_items');
    }
};
