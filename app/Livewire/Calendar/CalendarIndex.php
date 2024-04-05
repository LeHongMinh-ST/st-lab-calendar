<?php

declare(strict_types=1);

namespace App\Livewire\Calendar;

use App\Enums\Role;
use App\Enums\Status;
use App\Models\Calendar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class CalendarIndex extends Component
{
    use WithPagination;

    public string|int|null $calendarId = null;

    public string $search = '';

    protected $listeners = [
        'deleteCalendar' => 'deleteCalendar',
    ];

    public function openDeleteModal($id): void
    {
        $this->calendarId = $id;
        $this->dispatch('openDeleteModal');
    }

    public function render(): View|Application|Factory
    {
        $perPage = config('constants.per_page_admin', 10);

        $calendars = Calendar::with('team')
            ->when(Role::User === auth()->user()->role, function ($query) {
                return $query->where('user_id', auth()->user()->id)
                    ->where('status', '!=', Status::Draft->value);
            })
            ->orderBy('created_at', 'desc')
            ->search($this->search)
            ->paginate($perPage);

        return view('livewire.calendar.calendar-index')->with([
            'calendars' => $calendars,
        ]);
    }

    public function deleteCalendar(): void
    {
        try {
            $calendar = Calendar::find($this->calendarId);
            if (Status::Active === $calendar->status) {
                $calendar->status = Status::Draft;
                $calendar->save();
            } else {
                foreach ($calendar->events as $event) {
                    $event->activity()->delete();
                }
                $calendar->events()->delete();
                $calendar->delete();
            }
            $this->dispatch('alert', type: 'success', message: 'Xóa thành công!');
        } catch (Exception $e) {
            Log::error('Error delete calendar', [
                'method' => __METHOD__,
                'message' => $e->getMessage(),
            ]);
            $this->dispatch('alert', type: 'error', message: 'Xóa thất bại!');
        }
    }
}
