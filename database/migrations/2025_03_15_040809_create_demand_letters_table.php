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
        Schema::create('demand_letters', function (Blueprint $table) {
            $table->id()->primary('PK_DEMAND_LETTERS');
            $table->string('reference_number', 50)->unique()->nullable(false)->comment('Format: №-XXXXX');
            $table->foreignId('section_id')->constrained('sections');
            $table->date('letter_date')->nullable(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // Add indexes
            $table->index('reference_number', 'IDX_DEMAND_LETTERS_REF_NUMBER');
            $table->index('letter_date', 'IDX_DEMAND_LETTERS_DATE');
            $table->index('section_id', 'IDX_DEMAND_LETTERS_SECTION_ID');
        });

        // Set default timezone for timestamps to UTC+5
        DB::statement('ALTER TABLE demand_letters ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
        DB::statement('ALTER TABLE demand_letters ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');

        // Create sequence for reference numbers if it doesn't exist
        DB::statement('DROP SEQUENCE IF EXISTS demand_letters_ref_seq');
        DB::statement('CREATE SEQUENCE demand_letters_ref_seq START WITH 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP SEQUENCE IF EXISTS demand_letters_ref_seq');
        Schema::dropIfExists('demand_letters');
    }
};
