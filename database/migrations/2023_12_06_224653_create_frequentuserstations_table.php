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
        Schema::create('frequentuserstations', function (Blueprint $table) {
            $table->integer('userId');
            $table->integer('stationId');
            $table->primary(['userId', 'stationId']); // Composite primary key.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frequentuserstations');
    }
};
