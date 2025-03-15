<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units_of_measurement', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique()->comment('Unit name (e.g., Tablet, Milliliter)');
            $table->string('code', 10)->unique()->comment('Short code (e.g., TAB, ML)');
            $table->string('category', 50)->comment('Category (e.g., Volume, Count, Weight)');
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // Add indexes
            $table->index('name', 'IDX_UOM_NAME');
            $table->index('code', 'IDX_UOM_CODE');
            $table->index('category', 'IDX_UOM_CATEGORY');
        });

        // Set default timezone for timestamps to UTC+5
        DB::statement('ALTER TABLE units_of_measurement ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
        DB::statement('ALTER TABLE units_of_measurement ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');

        // Insert common pharmaceutical units
        DB::table('units_of_measurement')->insert([
            ['name' => 'Штука', 'code' => 'шт', 'category' => 'Count'],
            ['name' => 'Упаковка', 'code' => 'уп', 'category' => 'Count'],
            ['name' => 'Миллилитр', 'code' => 'мл', 'category' => 'Volume'],
            ['name' => 'Килограмм', 'code' => 'кг', 'category' => 'Weight'],
            ['name' => 'Грамм', 'code' => 'г', 'category' => 'Weight'],
            ['name' => 'Ампула', 'code' => 'ам', 'category' => 'Count'],
            ['name' => 'Флакон', 'code' => 'фл', 'category' => 'Count'],
            ['name' => 'Бутылка', 'code' => 'бот', 'category' => 'Count'],
            ['name' => 'Коробка', 'code' => 'кор', 'category' => 'Count'],
            ['name' => 'Полоска', 'code' => 'пол', 'category' => 'Count'],
            ['name' => 'Комплект', 'code' => 'ком', 'category' => 'Count'],
            ['name' => 'Пара', 'code' => 'пар', 'category' => 'Count'],
            ['name' => 'Пачка', 'code' => 'пач', 'category' => 'Count'],
            ['name' => 'Набор', 'code' => 'наб', 'category' => 'Count'],
            ['name' => 'Труба', 'code' => 'труб', 'category' => 'Count'],
            ['name' => 'Сачет', 'code' => 'сач', 'category' => 'Count'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('units_of_measurement');
    }
};
