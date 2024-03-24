<?php

namespace App\Livewire\Calendar;

use DateTime;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CalendarCreate extends Component
{

    #[Validate('required', as: 'tiêu đề')]
    public string $title = '';

    #[Validate('required', as: 'ngày bắt đầu')]
    public string $startDate = '';

    #[Validate('required', as: 'ngày kết thúc')]
    public string $endDate = '';

    #[Validate('required', as: 'thời gian bắt đầu')]
    public string $startTime = '';

    #[Validate('required', as: 'thời gian kết thúc')]
    public string $endTime = '';

    protected $listeners = [
        'update-start-date' => 'updateStartDate',
        'update-end-date' => 'updateEndDate',
    ];


    public function submit(): void
    {
        $this->validate();
    }

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.calendar.calendar-create');
    }

    public function updateStartDate($value): void
    {
        if ($value) {
            $this->resetValidation('startDate');
        }
        $this->startDate = $value;
    }

    public function updateEndDate($value): void
    {
        if ($value) {
            $this->resetValidation('endDate');
        }
        $this->endDate = $value;
    }

    #[Computed]
    public function totalTime(): string
    {
        if ($this->startTime && $this->endTime) {
            $start = new DateTime($this->startTime);
            $end = new DateTime($this->endTime);
            return $start->diff($end)->format('%h giờ %i phút');
        }
        return '';
    }

    #[Computed]
    public function maxTime(): string
    {
        if ($this->startDate && $this->endDate) {
           if ($this->startDate == $this->endDate) {
               $startTime = Carbon::parse($this->startTime);
               return $startTime->copy()->subMinutes(30)->format('H:i');
           }
        }
        return '';
    }

}
