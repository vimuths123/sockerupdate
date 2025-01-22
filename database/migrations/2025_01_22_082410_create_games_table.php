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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_a_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('team_b_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('winner_team_id')->nullable()->constrained('teams')->onDelete('set null');
            $table->integer('team_a_goals')->default(0);
            $table->integer('team_b_goals')->default(0);
            $table->string('location');
            $table->enum('status', ['Scheduled', 'In Progress', 'Finished'])->default('Scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
