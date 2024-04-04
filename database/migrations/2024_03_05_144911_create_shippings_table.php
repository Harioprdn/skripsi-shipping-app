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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('number', 32)->unique();
            $table->string('sender_name');
            $table->string('sender_address');
            $table->string('sender_phone');
            $table->string('receiver_name');
            $table->string('receiver_address');
            $table->string('receiver_phone');
            $table->foreignId('items_id')->constrained('items');
            $table->integer('quantity');
            $table->integer('item_weight');
            $table->date('shipping_date');
            $table->text('description')->nullable();
            $table->foreignId('costs_id')->constrained('costs');
            $table->decimal('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
