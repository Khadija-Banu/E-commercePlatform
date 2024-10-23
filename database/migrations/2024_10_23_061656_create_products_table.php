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
            $table->unsignedBigInteger('subcategory_id'); // Make sure it's unsignedBigInteger
            $table->unsignedBigInteger('category_id');
            $table->string('product_name');
            $table->text('description');
            $table->string('product_image')->nullable(); // For product images
            $table->decimal('old_price', 10, 2)->nullable(); // For old price
            $table->decimal('new_price', 10, 2); // For new price
             // Foreign Key Constraint
            //  $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->timestamps();


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