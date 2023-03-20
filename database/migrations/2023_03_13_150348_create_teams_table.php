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
    Schema::create('teams', function (Blueprint $table) {
        $table->bigIncrements('codice_squadra');
        $table->string('nome')->nullable(false);
        $table->string('citta')->nullable(false);
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable(); 
    });
}

public function down(): void
{
    Schema::dropIfExists('teams');
}
};
