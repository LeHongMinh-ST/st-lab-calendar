<?php

declare(strict_types=1);

namespace App\View\Components\Seminar;

use App\Common\Constants;
use App\Models\Event;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeminarItem extends Component
{
    public string $dayOfWeek;
    public string $date;
    public string $monthYear;
    public string $time;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public readonly Event $event,
        public readonly bool  $new = false
    ) {
        /*
         * @var Carbon $dateCarbon
         */
        $dateCarbon = Carbon::createFromFormat(Constants::FORMAT_DATE, $this->event->day);

        /*
         * @var Carbon $timeCarbon
         */
        $timeCarbon = Carbon::parse($this->event->start_time);

        $this->dayOfWeek = $dateCarbon->dayName;
        $this->date = $dateCarbon->format('d');
        $this->monthYear = $dateCarbon->format('m/Y');
        $this->time = $timeCarbon->format('H\hi');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seminar.seminar-item');
    }
}
