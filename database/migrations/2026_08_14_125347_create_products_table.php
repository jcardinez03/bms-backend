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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('SKU');
            $table->decimal('cost', 10,2);
            $table->decimal('selling_price', 10,2);
            $table->decimal('competitor_price', 10,2)->nullable();
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('category_id');
            $table->boolean('is_active')
                ->default(true);
            $table->timestamps();

            $table->foreign('business_id')->references('id')->on('businesses');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
