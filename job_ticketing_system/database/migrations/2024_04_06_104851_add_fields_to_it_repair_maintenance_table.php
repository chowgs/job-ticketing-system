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
        Schema::table('it_repair_maintenance', function (Blueprint $table) {
            $table->date('date_received')->nullable();
            $table->date('date_returned')->nullable();
            $table->dateTime('datetime_started')->nullable();
            $table->dateTime('datetime_accomplished')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('it_repair_maintenance', function (Blueprint $table) {
            $table->dropColumn('date_received');
            $table->dropColumn('date_returned');
            $table->dropColumn('datetime_started');
            $table->dropColumn('datetime_accomplished');
        });
    }
};
