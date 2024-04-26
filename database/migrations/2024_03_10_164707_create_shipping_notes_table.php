<?php

use App\Models\Driver;
use App\Models\Shipping;
use Illuminate\Database\Eloquent\Model;
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
            $table->foreignId('drivers_id')->nullable()->constrained('drivers')->cascadeOnDelete();
            $table->json('shippings_id')->nullable()->constrained('shippings')->cascadeOnDelete();
            $table->string('vehicle');
            $table->string('number_plate');
            $table->dateTime('shippings_date');
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
