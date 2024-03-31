<?php

namespace App\Livewire\User;

use App\Enums\Role;
use App\Enums\Status;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    public string $search = '';
    public string $role = '';
    public string $status = '';

    protected $listeners = [
    ];

    public function render()
    {
        $perPage = config('constants.per_page_admin', 2);

        $users = User::query()
            ->search($this->search)
            ->filterRole($this->role)
            ->filterStatus($this->status)
            ->paginate($perPage);
        return view('livewire.user.user-index')->with([
            'users' => $users,
            'roles' => Role::displayAll(),
            'statuses' => Status::displayAll(),
        ]);
    }
}
