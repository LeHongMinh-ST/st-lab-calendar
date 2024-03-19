<?php

use App\Enums\Status;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->integer('team_id');
            $table->integer('user_id');
            $table->enum('status', array_map(fn ($status) => $status->value, Status::cases()))
                ->default(Status::Active->value);
            $table->string('date_of_week');
            $table->string('day');
            $table->string('start_time');
            $table->string('end_time');
            $table->integer('loop');
            $table->tinyInteger('week_loop');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
