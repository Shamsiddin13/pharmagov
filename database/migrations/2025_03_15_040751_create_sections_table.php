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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('department_head', 255)->nullable(false);
            $table->string('head_nurse', 255)->nullable(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // Add indexes for commonly searched fields
            $table->index('name', 'IDX_SECTIONS_NAME');
            $table->index('department_head', 'IDX_SECTIONS_DEPARTMENT_HEAD');
            $table->index('head_nurse', 'IDX_SECTIONS_HEAD_NURSE');
        });

        // Set default timezone for timestamps to UTC+5
        DB::statement('ALTER TABLE sections ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
        DB::statement('ALTER TABLE sections ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
