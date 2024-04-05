<?php

declare(strict_types=1);

namespace App\Livewire\Calendar;

use App\Enums\Status;
use App\Models\Calendar;
use App\Models\Event;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithPagination;

class CalendarApprove extends Component
{
    use WithPagination;

    public $calendarId;
    public $statusCalendar = "";

    private $calendar;

    private $events;

    public function mount($calendarId): void
    {
        $this->calendarId = $calendarId;
    }

    public function getCalendar($calendarId): void
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

    public function render(): View|Application|Factory
    {
        $this->getCalendar($this->calendarId);


        return view('livewire.calendar.calendar-approve')->with([
            'events' => $this->events,
            'calendar' => $this->calendar,
            'statuses' => Status::displayAllStatusApprove(),
        ]);
    }

    public function update(): RedirectResponse|Redirector|null
    {
        try {
            if ((bool) ($this->statusCalendar)) {
                Calendar::where('id', $this->calendarId)->update(['status' => Status::Active]);
                session()->flash('success', 'Cập nhật thành công');
                return redirect()->route('admin.calendar.approve-list');
            }
        } catch (Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Cập nhật thất bại!');
        }
        return null;
    }
}
