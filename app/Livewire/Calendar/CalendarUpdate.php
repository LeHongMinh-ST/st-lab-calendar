<?php

namespace App\Livewire\Calendar;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class CalendarUpdate extends Component
{
    public function render(): View|Application|Factory
    {
        return view('livewire.calendar.calendar-update');
    }
}
