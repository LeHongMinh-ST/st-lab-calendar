<?php

declare(strict_types=1);

namespace App\View\Components\Seminar;

use App\Models\Event;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeminarItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Event $event
    ) {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seminar.seminar-item');
    }
}
