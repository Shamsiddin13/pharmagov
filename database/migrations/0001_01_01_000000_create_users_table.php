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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        // Set default timezone for timestamps to UTC+5
        DB::statement('ALTER TABLE users ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
        DB::statement('ALTER TABLE users ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->useCurrent();
        });

        // Set default timezone for timestamp to UTC+5
        DB::statement('ALTER TABLE password_reset_tokens ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        // Set default timezone for timestamps to UTC+5
        DB::statement('ALTER TABLE sessions ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
        DB::statement('ALTER TABLE sessions ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
