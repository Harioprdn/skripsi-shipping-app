<?php

use App\Models\Driver;
use App\Models\Shipping;
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
        Schema::create('shipping_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Driver::class);
            $table->foreignIdFor(Shipping::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippingnotes');
    }
};
