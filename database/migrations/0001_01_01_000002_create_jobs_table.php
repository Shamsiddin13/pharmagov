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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->timestamp('created_at')->useCurrent();
        });

        // Set default timezone for timestamp to UTC+5
        DB::statement('ALTER TABLE jobs ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('finished_at')->nullable();
        });

        // Set default timezone for timestamps to UTC+5
        DB::statement('ALTER TABLE job_batches ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
        DB::statement('ALTER TABLE job_batches ALTER COLUMN cancelled_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
        DB::statement('ALTER TABLE job_batches ALTER COLUMN finished_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        // Set default timezone for timestamp to UTC+5
        DB::statement('ALTER TABLE failed_jobs ALTER COLUMN failed_at SET DEFAULT CURRENT_TIMESTAMP AT TIME ZONE \'UTC+5\'');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
