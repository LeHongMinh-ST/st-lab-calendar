<?php

declare(strict_types=1);

namespace App\Livewire\Calendar;

use App\Models\Calendar;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class CalendarApproveList extends Component
{
    use WithPagination;

    public string|int|null $calendarId = null;

    public string $search = '';

    protected $listeners = [
        'approveCalendar' => 'approveCalendar',
    ];

    public function openApproveModal($id): void
    {
        $this->calendarId = $id;
        $this->dispatch('openApproveModal');
    }

    public function render(): View|Application|Factory
    {
        $perPage = config('constants.per_page_admin', 10);

        $calendars = Calendar::with('team')
            ->where('user_id', auth()->user()->id)
            ->search($this->search)
            ->orderBy('status', 'desc')
            ->orderBy('created_at', 'asc')
            ->paginate($perPage);

        return view('livewire.calendar.calendar-approve-list')->with([
            'calendars' => $calendars,
        ]);
    }

    public function approveCalendar($status): void
    {
        if ($this->calendarId) {
            Calendar::find($this->calendarId)->update([
                'status' => $status,
            ]);
            $this->dispatch('alert', type: 'success', message: 'Cập nhật thành công!');
        }
    }
}
