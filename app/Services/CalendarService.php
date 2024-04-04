<?php

declare(strict_types=1);

namespace App\Services;

use App\Common\Constants;
use App\Enums\ActivityType;
use App\Enums\CalendarLoop;
use App\Models\Activity;
use App\Models\Calendar;
use Carbon\Carbon;

class CalendarService
{
    private Calendar $calendar;

    private ActivityType $activityType = ActivityType::Report;

    private string $seminarUser = '';

    private string $content = '';

    public static function forCalendar(Calendar $calendar): self
    {
        $instance = new self();
        $instance->calendar = $calendar;

        return $instance;
    }

    public function withActivityType(ActivityType $activityType): self
    {
        $this->activityType = $activityType;

        return $this;
    }

    public function withSeminarUser(string $seminarUser): self
    {
        $this->seminarUser = $seminarUser;

        return $this;
    }

    public function withContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function createCalendarEvent(): void
    {
        $loop = $this->calendar->loop;

        switch ($loop) {
            case CalendarLoop::None:
                $this->createEvent();
                break;
            case CalendarLoop::Daily:
            case CalendarLoop::Weekly:
                $this->createRecurringEvent();
                break;
        }
    }

    private function createEvent(): void
    {
        $startDate = Carbon::parse($this->calendar->start_day);
        $this->createActivityAndEvent($startDate);
    }

    private function createRecurringEvent(): void
    {
        $startDate = Carbon::parse($this->calendar->start_day);
        $endDate = Carbon::parse($this->calendar->end_day);
        while ($startDate <= $endDate) {
            if ($this->isRecurringDay($startDate) || CalendarLoop::Daily === $this->calendar->loop) {
                $this->createActivityAndEvent($startDate);
            }

            $startDate->addDay();
        }
    }

    private function createActivityAndEvent(Carbon $dayTimestamp): void
    {
        $activity = Activity::create([
            'title' => $this->calendar->title,
            'start_time' => $this->calendar->start_time,
            'end_time' => $this->calendar->end_time,
            'type' => $this->activityType->value,
            'owner' => $this->seminarUser,
            'content' => $this->content ?? '',
        ]);

        $this->calendar->events()->create([
            'title' => $this->calendar->title,
            'start_time' => $this->calendar->start_time,
            'end_time' => $this->calendar->end_time,
            'day' => $dayTimestamp->format(Constants::FORMAT_DATE),
            'activity_id' => $activity->id,
            'team_id' => $this->calendar->team_id,
            'content' => $this->content ?? '',
        ]);
    }

    private function isRecurringDay(Carbon $date): bool
    {
        return CalendarLoop::Weekly === $this->calendar->loop && in_array($date->dayOfWeek, $this->calendar->date_of_week);
    }
}
