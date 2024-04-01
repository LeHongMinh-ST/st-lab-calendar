<?php

namespace App\Livewire\User;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    public mixed $userId = null;
    public string $search = '';
    public string $role = '';
    public string $status = '';

    protected $listeners = [
        'deleteUser' => 'destroy',
    ];

    public function openDeleteModal($id): void
    {
        $this->userId = $id;
        $this->dispatch('openDeleteModal');
    }

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
            'statuses' => UserStatus::displayAll(),
        ]);
    }

    public function destroy()
    {
        try {
            if (auth()->user()->id == $this->userId) {
                $this->dispatch('alert', type: 'success', message: 'Không thể xóa tài khoản đang đăng nhập!');
                return;
            }
            User::destroy($this->userId);
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
