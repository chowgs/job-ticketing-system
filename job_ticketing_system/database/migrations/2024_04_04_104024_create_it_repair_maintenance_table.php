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
        Schema::create('it_repair_maintenance', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number');
            $table->string('department');
            $table->text('requests')->nullable();
            $table->string('others_specify')->nullable();
            $table->string('attending_personnel');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('it_repair_maintenance');
    }
};