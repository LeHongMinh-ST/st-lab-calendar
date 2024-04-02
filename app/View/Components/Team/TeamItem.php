<?php

namespace App\View\Components\Team;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TeamItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string $thumbnail,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.team.team-item');
    }
}
