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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('SKU')->unique();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('status_id');
            $table->integer('stock');
            $table->integer('reorder_at');
            $table->integer('reorder_qty');
            $table->decimal('unit_cost', 12,2);
            $table->decimal('stock_value', 14,2);
            $table->unsignedBigInteger('location_id');
            $table->date('last_restocked_at');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
