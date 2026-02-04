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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('restaurant_name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->text('address')->nullable();
            $table->string("city")->nullable();
            $table->string("postcode")->nullable();
            $table->string("state")->nullable();
            $table->string("country")->nullable();

            $table->string('currency_code')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->decimal('tax_percentage', 10, 2)->nullable();

            $table->decimal('delivery_charge', 10, 2)->nullable();
            $table->decimal('min_order_amount', 10, 2)->nullable();

            $table->boolean('is_order_enabled')->default(true);
            $table->boolean('is_delivery_enabled')->default(true);
            $table->boolean('is_pickup_enabled')->default(true);

            $table->boolean('is_cod_enabled')->default(true);
            $table->boolean('is_online_enabled')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
