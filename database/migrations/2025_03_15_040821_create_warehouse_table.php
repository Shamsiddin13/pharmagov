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
        Schema::create('warehouse', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('section_id')->constrained('sections');
            $table->foreignId('paragraph_id')->constrained('paragraphs');
            $table->foreignId('polyclinic_id')->constrained('polyclinics');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->foreignId('demand_letter_id')->constrained('demand_letters');
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->date('date');
            $table->decimal('total_amount', 20, 2)->default(0.00);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // Add index for user_id for better query performance
            $table->index('user_id', 'IDX_WAREHOUSE_USER_ID');
        });

        // Set default timezone for timestamps to UTC+5
        DB::statement('ALTER TABLE warehouse ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
        DB::statement('ALTER TABLE warehouse ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse');
    }
};
