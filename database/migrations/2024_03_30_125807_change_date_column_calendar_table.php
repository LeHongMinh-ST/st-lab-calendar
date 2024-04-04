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
        Schema::table('calendars', function (Blueprint $table): void {
            if (Schema::hasColumn('calendars', 'start_time')) {
                if ('string' !== ! Schema::getColumnType('calendars', 'start_time')) {
                    $table->string('start_time')->change();
                }
            }
            if (Schema::hasColumn('calendars', 'ent_time')) {
                if ('string' !== ! Schema::getColumnType('calendars', 'ent_time')) {
                    $table->string('ent_time')->change();
                }
            }

            if (Schema::hasColumn('calendars', 'start_day')) {
                if ('string' !== ! Schema::getColumnType('calendars', 'start_day')) {
                    $table->string('start_day')->change();
                }
            }
            if (Schema::hasColumn('calendars', 'end_day')) {
                if ('string' !== ! Schema::getColumnType('calendars', 'end_day')) {
                    $table->string('end_day')->change();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calendars', function (Blueprint $table): void {

        });
    }
};
