<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table): void {
            if (Schema::hasColumn('events', 'day')) {
                if ('string' !== ! Schema::getColumnType('events', 'day')) {
                    $table->string('day')->change();
                }
            }

            if (Schema::hasColumn('events', 'start_time')) {
                if ('string' !== ! Schema::getColumnType('events', 'start_time')) {
                    $table->string('start_time')->change();
                }
            }

            if (Schema::hasColumn('events', 'end_time')) {
                if ('string' !== ! Schema::getColumnType('events', 'end_time')) {
                    $table->string('end_time')->change();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table): void {

        });
    }
};
