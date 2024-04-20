<?php

namespace App\Livewire\Team;

use App\Models\Team;
use Livewire\Component;
use Livewire\WithPagination;

class TeamIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        $perPage = config('constants.per_page_admin', 2);

        $teams = Team::query()
            ->search($this->search)
            ->paginate($perPage);
        return view('livewire.team.team-index')->with([
            'teams' => $teams,
        ]);
    }
}
