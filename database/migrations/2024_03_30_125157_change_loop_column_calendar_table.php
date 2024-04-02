<?php

use App\Enums\CalendarLoop;
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
            if (Schema::hasColumn('calendars', 'loop')) {
                if (! Schema::getColumnType('calendars', 'loop') !== 'enum') {
                    $table->enum('loop', array_map(fn ($status) => $status->value, CalendarLoop::cases()))
                        ->default(CalendarLoop::None->value)->change();
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
