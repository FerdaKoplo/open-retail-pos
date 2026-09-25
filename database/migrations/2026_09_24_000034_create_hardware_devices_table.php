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
        Schema::create('hardware_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->nullable()->constrained('hardware_agents')->nullOnDelete();
            $table->foreignId('register_id')->constrained('registers')->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('type', 50);
            $table->string('connection_type', 50);
            $table->json('configuration');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hardware_devices');
    }
};
