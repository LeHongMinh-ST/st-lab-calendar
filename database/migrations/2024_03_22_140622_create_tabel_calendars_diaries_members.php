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
        Schema::create('members', function (Blueprint $table): void {
            $table->id();
            $table->string('email')->nullable();
            $table->string('class_code')->nullable();
            $table->string('student_code')->nullable();
            $table->string('full_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedInteger('team_id')->nullable()->index();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('calendars', function (Blueprint $table): void {
            $table->id();
            $table->string('title')->nullable();
            $table->string('status')->nullable();
            $table->string('date_of_week')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('ent_time')->nullable();
            $table->date('start_day')->nullable();
            $table->date('end_day')->nullable();
            $table->integer('week_loop')->nullable();
            $table->integer('loop')->nullable();
            $table->unsignedInteger('team_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();
        });

        Schema::create('diaries', function (Blueprint $table): void {
            $table->id();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->string('report_status')->nullable();
            $table->text('report')->nullable();
            $table->string('room_status')->nullable();
            $table->unsignedInteger('event_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
        Schema::dropIfExists('calendars');
        Schema::dropIfExists('diaries');
    }
};
