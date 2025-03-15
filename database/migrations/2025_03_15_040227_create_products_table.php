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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->comment('Primary Key');
            $table->string('name', 255);
            $table->foreignId('substance_id')->constrained('substances');
            $table->foreignId('unit_of_measurement_id')->constrained('units_of_measurement');
            $table->decimal('unit_price', 20, 2)->default(0.00)->nullable();
            $table->boolean('is_available')->default(true)->nullable(false);
            // Timestamps with timezone
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // Constraints
            $table->foreign('substance_id', 'FK_PRODUCTS_SUBSTANCES')
                  ->references('id')
                  ->on('substances')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->foreign('unit_of_measurement_id', 'FK_PRODUCTS_UNITS_OF_MEASUREMENT')
                  ->references('id')
                  ->on('units_of_measurement')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            // Primary Key constraint name
            $table->primary('id', 'PK_PRODUCTS');

            // Add indexes
            $table->index('name', 'IDX_PRODUCTS_NAME');
            $table->index('unit_price', 'IDX_PRODUCTS_PRICE');
            $table->index('is_available', 'IDX_PRODUCTS_AVAILABLE');
        });

        // Set default timezone for timestamps to UTC+5
        DB::statement('ALTER TABLE products ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
        DB::statement('ALTER TABLE products ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes first
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('IDX_PRODUCTS_NAME');
            $table->dropIndex('IDX_PRODUCTS_PRICE');
            $table->dropIndex('IDX_PRODUCTS_AVAILABLE');
        });

        Schema::dropIfExists('products');
    }
};
