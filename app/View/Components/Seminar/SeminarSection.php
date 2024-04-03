<?php

declare(strict_types=1);

namespace App\View\Components\Seminar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class SeminarSection extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public readonly Collection|array $events,
        public readonly bool             $new = false
    ) {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seminar.seminar-section');
    }
}
