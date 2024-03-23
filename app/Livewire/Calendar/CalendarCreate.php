<?php

namespace App\Livewire\Calendar;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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
        $this->startDate = $value;
    }

    public function updateEndDate($value): void
    {
        $this->endDate = $value;
    }
}
