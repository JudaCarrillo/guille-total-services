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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->string('name');
            $table->string('paternal_surname');
            $table->string('maternal_surname');
            $table->date('data_of_birth')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_type');
            $table->string('verified_state');
            $table->date('verified_at');
            $table->char('status')->default('A');
            $table->timestamps();
        });
        
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
