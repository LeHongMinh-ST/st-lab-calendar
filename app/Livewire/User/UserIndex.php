<?php

declare(strict_types=1);

namespace App\Livewire\User;

use App\Common\Constants;
use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    public string|int|null $userId = null;

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

    public function render(): View|Application|Factory
    {
        $users = User::query()
            ->search($this->search)
            ->filterRole($this->role)
            ->filterStatus($this->status)
            ->paginate(Constants::PER_PAGE_ADMIN);

        return view('livewire.user.user-index')->with([
            'users' => $users,
            'roles' => Role::displayAll(),
            'statuses' => UserStatus::displayAll(),
        ]);
    }

    public function destroy(): void
    {
        try {
            if (auth()->user()->id === $this->userId) {
                $this->dispatch('alert', type: 'success', message: 'Không thể xóa tài khoản đang đăng nhập!');

                return;
            }
            User::destroy($this->userId);
            $this->dispatch('alert', type: 'success', message: 'Xóa thành công!');
        } catch (Exception $e) {
            Log::error('Error delete user', [
                'method' => __METHOD__,
                'message' => $e->getMessage(),
            ]);
            $this->dispatch('alert', type: 'error', message: 'Xóa thất bại!');
        }
    }
}
