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
        Schema::create('monitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->enum('type', ['email', 'domain'])->default('email');
            $table->string('value'); // email address or domain
            $table->timestamp('last_scanned_at')->nullable();
            $table->boolean('is_active')->default(true); // Allow disabling monitors
            $table->text('notes')->nullable(); // Optional notes about the monitor
            $table->timestamps();

            // Ensure unique monitors per team
            $table->unique(['team_id', 'value']);

            // Index for efficient scanning
            $table->index(['type', 'is_active', 'last_scanned_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitors');
    }
};
