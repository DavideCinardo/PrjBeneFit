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
        Schema::create('team_player', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_team');
            $table->foreign('id_team')->references('codice_squadra')->on('teams')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('id_player');
            $table->foreign('id_player')->references('codice_tessera')->on('players')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_player');
    }
};
