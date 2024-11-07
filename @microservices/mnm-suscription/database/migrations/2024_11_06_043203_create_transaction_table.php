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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_id')->unique();
            $table->foreignId('membership_id')->nullable()->references('id')->on('membership')->onDelete('cascade')->onUpdate('cascade');
            $table->string('uuid')->nullable();
            $table->integer('amount')->nullable();
            $table->string('reference')->nullable();
            $table->foreignId('payment_processor_id')->nullable()->references('id')->on('payment_processor')->onDelete('cascade')->onUpdate('cascade');
            $table->char('status')->default('A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
