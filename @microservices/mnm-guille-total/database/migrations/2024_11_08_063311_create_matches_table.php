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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->string('match_id')->unique();
            $table->string('rival')->nullable();
            $table->string('rival_confederation')->nullable();
            $table->string('peru_score')->nullable();
            $table->string('rival_score')->nullable();
            $table->string('peru_awarded_score')->nullable();
            $table->string('rival_awarded_score')->nullable();
            $table->string('result')->nullable();
            $table->string('shootout_result')->nullable();
            $table->string('awarded_result')->nullable();
            $table->string('tournament_name')->nullable();
            $table->string('tournament_type')->nullable();
            $table->string('official')->nullable();
            $table->string('stadium')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('elevation')->nullable();
            $table->string('peru_condition')->nullable();
            $table->string('coach')->nullable()->nullable();
            $table->string('coach_nationality')->nullable();
            $table->string('date')->nullable();
            $table->string('porcentaje_gana')->nullable();
            $table->string('porcentaje_empate')->nullable();
            $table->string('porcentaje_pierde')->nullable();
            $table->char('evento', 1)->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
