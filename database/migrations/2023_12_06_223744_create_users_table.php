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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // TODO: Check if this is working in terms of authentication.

            // Account details (generated).
            $table->string('name'); // Or as previously known, 'username'.
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->rememberToken();

            // FrequentUser attributes.
            $table->string('firstName', 80);
            $table->string('lastName', 80);
            $table->float('balance'); // Money balance (saldo).
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
