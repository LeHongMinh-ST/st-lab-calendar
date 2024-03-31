<?php

namespace App\Livewire\Calendar;

use App\Models\Calendar;
use Livewire\Component;
use Livewire\WithPagination;

class CalendarIndex extends Component
{
    use WithPagination;
    public mixed $calendarId = null;
    public string $search = '';

    protected $listeners = [
        'deleteCalendar' => 'deleteCalendar',
    ];

    public function openDeleteModal($id): void
    {
        $this->calendarId = $id;
        $this->dispatch('openDeleteModal');
    }

    public function render()
    {
        $perPage = config('constants.per_page_admin', 10);

        $calendars = Calendar::with('team')
            ->where('user_id', auth()->user()->id)
            ->search($this->search)
            ->paginate($perPage);
        return view('livewire.calendar.calendar-index')->with([
            'calendars' => $calendars,
        ]);
    }

    public function deleteCalendar()
    {
        try {
            if (auth()->user()->id == $this->calendarId) {
                $this->dispatch('alert', type: 'error', message: 'Không thể xóa tài khoản đang đăng nhập!');
                return;
            }
            Calendar::destroy($this->calendarId);
            $this->dispatch('alert', type: 'success', message: 'Xóa thành công!');
        } catch (\Exception $e) {
            \Log::error('Error delete user', [
                'method' => __METHOD__,
                'message' => $e->getMessage()
            ]);

            $this->dispatch('alert', type: 'error', message: 'Xóa thất bại!');
        }
    }
}
