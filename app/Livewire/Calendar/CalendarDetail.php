<?php

namespace App\Livewire\Calendar;

use App\Models\Calendar;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class CalendarDetail extends Component
{
    use WithPagination;
    private $calendar;
    private $events;

    public $calendarId;

    public function mount($calendarId)
    {
        $this->calendarId = $calendarId;
    }

    public function getCalendar($calendarId)
    {
        $perPage = config('constants.per_page_admin', 10);
        $calendar = Calendar::find($calendarId);
        $events = Event::query()
            ->where('calendar_id', $calendarId)
            ->paginate($perPage);
        if ($calendar) {
            $this->calendar = $calendar;
            $this->events = $events;
        }
    }

    public function render()
    {
        $this->getCalendar($this->calendarId);
        return view('livewire.calendar.calendar-detail')->with([
            'events' => $this->events,
            'calendar' => $this->calendar,
        ]);
    }
}
