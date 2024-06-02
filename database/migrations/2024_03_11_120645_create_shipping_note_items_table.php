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
        Schema::create('shipping_note_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shippings_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('shipping_note_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('number');
            $table->enum('status', ['Baru', 'Diproses', 'Terkirim', 'Dibatalkan']);
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_note_items');
    }
};
