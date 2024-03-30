<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('calendars', function (Blueprint $table) {
            if (Schema::hasColumn('calendars', 'start_time')) {
                if (!Schema::getColumnType('calendars', 'start_time') !== 'string') {
                    $table->string('start_time')->change();
                }
            }
            if (Schema::hasColumn('calendars', 'ent_time')) {
                if (!Schema::getColumnType('calendars', 'ent_time') !== 'string') {
                    $table->string('ent_time')->change();
                }
            }

            if (Schema::hasColumn('calendars', 'start_day')) {
                if (!Schema::getColumnType('calendars', 'start_day') !== 'string') {
                    $table->string('start_day')->change();
                }
            }
            if (Schema::hasColumn('calendars', 'end_day')) {
                if (!Schema::getColumnType('calendars', 'end_day') !== 'string') {
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
        Schema::table('calendars', function (Blueprint $table) {
            //
        });
    }
};
