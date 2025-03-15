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
        Schema::create('warehouse_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('warehouse');
            $table->foreignId('product_id')->constrained('products');
            $table->float('quantity');
            $table->decimal('unit_price', 20, 2);
            $table->decimal('sub_total', 20, 2);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        // Set default timezone for timestamps to UTC+5
        DB::statement('ALTER TABLE warehouse_items ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
        DB::statement('ALTER TABLE warehouse_items ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');

        // Create indexes for better performance
        DB::statement('CREATE INDEX IDX_WAREHOUSE_ITEMS_WAREHOUSE_ID ON warehouse_items (warehouse_id)');
        DB::statement('CREATE INDEX IDX_WAREHOUSE_ITEMS_PRODUCT_ID ON warehouse_items (product_id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_items');
    }
};
