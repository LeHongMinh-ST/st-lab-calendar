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
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'day')) {
                if (!Schema::getColumnType('events', 'day') !== 'string') {
                    $table->string('day')->change();
                }
            }

            if (Schema::hasColumn('events', 'start_time')) {
                if (!Schema::getColumnType('events', 'start_time') !== 'string') {
                    $table->string('start_time')->change();
                }
            }

            if (Schema::hasColumn('events', 'end_time')) {
                if (!Schema::getColumnType('events', 'end_time') !== 'string') {
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
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
};
