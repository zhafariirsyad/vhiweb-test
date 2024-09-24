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
            $table->unsignedBigInteger('vendor_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category');
            $table->decimal('price', 15, 2);
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('brand')->nullable();
            $table->enum('status',['publish','draft']);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
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
