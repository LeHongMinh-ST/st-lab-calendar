<?php

namespace App\Services;

use App\Enums\CalendarLoop;
use App\Models\Activity;
use App\Models\Calendar;
use Carbon\Carbon;

class CalendarService
{
    public function createCalendarEvent(Calendar $calendar): void
    {
        $loop = $calendar->loop;

        switch ($loop) {
            case CalendarLoop::None:
                $this->createEvent($calendar);
                break;
            case CalendarLoop::Daily :
            case CalendarLoop::Weekly:
                $this->createRecurringEvent($calendar);
                break;
        }
    }

    private function createEvent(Calendar $calendar): void
    {
        $startDate = Carbon::parse($calendar->start_day);
        $this->createActivityAndEvent($calendar, $startDate);
    }

    private function createRecurringEvent(Calendar $calendar): void
    {
        $startDate = Carbon::parse($calendar->start_day);
        $endDate = Carbon::parse($calendar->end_day);
        while ($startDate <= $endDate) {
            if ($this->isRecurringDay($calendar, $startDate) || $calendar->loop === CalendarLoop::Daily) {
                $this->createActivityAndEvent($calendar, $startDate);
            }

            $startDate->addDay();
        }
    }

    private function createActivityAndEvent(Calendar $calendar, Carbon $dayTimestamp): void
    {

        $activity = Activity::create([
            'title' => $calendar->title,
            'start_time' => $calendar->start_time,
            'end_time' => $calendar->end_time,
            'day' => $dayTimestamp->timestamp,
        ]);


        $calendar->events()->create([
            'title' => $calendar->title,
            'start_time' => $calendar->start_time,
            'end_time' => $calendar->end_time,
            'day' => $dayTimestamp->timestamp,
            'activity_id' => $activity->id,
            'team_id' => $calendar->team_id,
        ]);
    }

    private function isRecurringDay(Calendar $calendar, Carbon $date): bool
    {
        return $calendar->loop === CalendarLoop::Weekly && in_array($date->dayOfWeek, $calendar->date_of_week);
    }
}
