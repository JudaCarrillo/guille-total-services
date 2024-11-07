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
        Schema::create('payment_processor', function (Blueprint $table) {
            $table->id();
            $table->integer('payment_processor_id')->unique();
            $table->string('uuid')->nullable();
            $table->string('description')->nullable();
            $table->json('payment_method')->nullable();
            $table->char('status')->default('A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_processor');
    }
};
