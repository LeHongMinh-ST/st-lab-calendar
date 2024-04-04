<?php

declare(strict_types=1);

use App\Enums\ActivityType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table): void {
            if (Schema::hasColumn('activities', 'type')) {
                if ('enum' !== Schema::getColumnType('activities', 'type')) {
                    $table->enum('type', array_map(fn ($activityType) => $activityType->value, ActivityType::cases()))
                        ->nullable()
                        ->default(ActivityType::Report->value)->change();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table): void {

        });
    }
};
