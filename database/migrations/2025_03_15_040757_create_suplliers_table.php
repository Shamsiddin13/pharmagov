<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_person');
            $table->string('phone');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // Add indexes for commonly searched fields
            $table->index('name', 'IDX_SUPPLIERS_NAME');
            $table->index('phone', 'IDX_SUPPLIERS_PHONE');
        });

        // Set default timezone for timestamps to UTC+5
        DB::statement('ALTER TABLE suppliers ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
        DB::statement('ALTER TABLE suppliers ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
