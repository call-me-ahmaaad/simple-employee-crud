<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Add a unique constraint to the phone_number column
            $table->string('phone_number')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Drop the unique constraint from the phone_number column
            $table->dropUnique(['phone_number']);
        });
    }
};
