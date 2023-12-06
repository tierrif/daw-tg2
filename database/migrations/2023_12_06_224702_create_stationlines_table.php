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
        Schema::create('stationlines', function (Blueprint $table) {
            $table->integer('stationId');
            $table->integer('lineId');
            $table->primary(['stationId', 'lineId']); // Composite primary key.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stationlines');
    }
};
