<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
   public function up(): void
{
    Schema::create('delivery_zones', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('delivery_fee', 8, 2);
        $table->decimal('minimum_order_value', 8, 2)->nullable();
        $table->string('estimated_time')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_zones');
    }
};
