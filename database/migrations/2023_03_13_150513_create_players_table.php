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
    Schema::create('players', function (Blueprint $table) {
        $table->bigIncrements('codice_tessera');
        $table->string('nome')->nullable(false);
        $table->decimal('costo', 8);
        $table->string('ruolo')->nullable(false);
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    });
}

public function down(): void
{
    Schema::dropIfExists('players');
}
};
