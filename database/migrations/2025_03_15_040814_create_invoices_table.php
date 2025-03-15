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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->primary('PK_INVOICES');
            $table->string('reference_number', 50)->unique()->nullable(false)->comment('Format: №-XXXXX');
            $table->date('invoice_date')->nullable(false);
            $table->decimal('total_amount', 20, 2)->nullable(false)->default(0.00);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // Add indexes
            $table->index('reference_number', 'IDX_INVOICES_REF_NUMBER');
            $table->index('invoice_date', 'IDX_INVOICES_DATE');
        });

        // Set default timezone for timestamps to UTC+5
        DB::statement('ALTER TABLE invoices ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
        DB::statement('ALTER TABLE invoices ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');

        // Create sequence for reference numbers if it doesn't exist
        DB::statement('DROP SEQUENCE IF EXISTS invoices_ref_seq');
        DB::statement('CREATE SEQUENCE invoices_ref_seq START WITH 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP SEQUENCE IF EXISTS invoices_ref_seq');
        Schema::dropIfExists('invoices');
    }
};
