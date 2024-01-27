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
        Schema::create('frequentstations', function (Blueprint $table) {
            $table->integer('stationId');
            $table->integer('userId');
            $table->primary(['stationId', 'userId']); // Composite primary key.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frequentstations');
    }
};
