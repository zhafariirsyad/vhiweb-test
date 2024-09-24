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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('contact_name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('address');
            $table->mediumText('service_offered_description');
            $table->string('website')->nullable();
            $table->string('password');
            $table->boolean('agreement')->default(false);
            $table->enum('status', ['pending', 'approved', 'rejected', 'under_review', 'suspended', 'inactive'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
