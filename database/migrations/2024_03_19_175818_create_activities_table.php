<?php

use App\Enums\Type;
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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->enum('type', array_map(fn($type) => $type->value, Type::cases()));
            $table->string('date_of_week')->nullable();
            $table->string('day')->nullable();
            $table->unsignedInteger('event_id')->nullable()->index();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->string('author')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
