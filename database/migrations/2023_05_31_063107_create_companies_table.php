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
        Schema::create('companies', function (Blueprint $table) {
            $table->id(); // Unsigned, Autoincreament, Primary Key - BigInt
            $table->string('name');
            $table->string('address')->nullable();
            $table->integer('phoneno')->nullable();
            $table->string('website', 100)->nullable();
            $table->timestamps(); // created_at, updated_at - Timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};