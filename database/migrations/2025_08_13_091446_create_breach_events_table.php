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
        Schema::create('breach_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monitor_id')->constrained('monitors')->onDelete('cascade');
            $table->string('breach_name');
            $table->date('breach_date');
            $table->json('data_classes'); // Types of data exposed (emails, passwords, etc.)
            $table->text('description')->nullable();
            $table->string('source')->default('hibp'); // Source of the breach data
            $table->timestamp('added_at'); // When this breach was added to HIBP
            $table->boolean('is_new')->default(true); // Track if this is a newly discovered breach
            $table->timestamps();

            // Index for efficient querying
            $table->index(['monitor_id', 'breach_date']);
            $table->index(['is_new', 'added_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breach_events');
    }
};
