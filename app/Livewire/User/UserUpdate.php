<?php

declare(strict_types=1);

namespace App\Livewire\User;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class UserUpdate extends Component
{
    public mixed $userId = null;

    #[Validate(as: 'tên tài khoản')]
    public string $username = '';

    #[Validate(as: 'Họ và tên')]
    public string $full_name = '';

    #[Validate(as: 'email')]
    public string $email = '';

    #[Validate(as: 'số điện thoại')]
    public string $phone_number = '';

    #[Validate(as: 'mật khẩu')]
    public string $password = '';

    #[Validate(as: 'vai trò')]
    public string $role = '';

    #[Validate(as: 'trạng thái')]
    public string $status = '';

    public function rules(): array
    {
        $validate = [
            'username' => [
                'required',
                'unique:users,username,' . $this->userId . ',id',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $this->userId . ',id',
            ],
            'full_name' => 'required',
            'phone_number' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ( ! preg_match('/^[0-9]{10}$/', $value)) {
                        return $fail('số điện thoại chưa đúng định dạng ');
                    }

                    return true;
                },
            ],
        ];

        if (auth()->user()->id != $this->userId) {
            $validate = array_merge($validate, [
                'role' => 'required',
                'status' => 'required',
            ]);
        }

        return $validate;
    }

    public function mount($userId): void
    {
        $user = User::query()->find($userId);
        if ($user) {
            $this->username = $user->username;
            $this->phone_number = $user->phone_number ?? '';
            $this->full_name = $user->full_name ?? '';
            $this->email = $user->email ?? '';
            $this->role = $user->role?->value ?? '';
            $this->status = $user->status?->value ?? '';
        }
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.user.user-update')->with([
            'roles' => Role::displayAll(),
            'statuses' => UserStatus::displayAll(),
        ]);
    }

    public function update(): RedirectResponse|Redirector|null
    {
        $this->validate();
        $payload = $this->getAttributeNotEmpty();

        try {
            User::where('id', $this->userId)->update($payload);
            session()->flash('success', 'Cập nhật thành công');
            return redirect()->route('admin.users.index');
        } catch (Exception $e) {
            Log::error('Error update user', [
                'method' => __METHOD__,
                'message' => $e->getMessage(),
            ]);
            $this->dispatch('alert', type: 'error', message: 'Cập nhật thất bại!');
        }
        return null;
    }

    private function getAttributeNotEmpty(): array
    {
        $attributes = [
            'username' => $this->username,
            'phone_number' => $this->phone_number,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'role' => $this->role,
            'status' => $this->status,
        ];

        return collect($attributes)->filter(fn ($value) => ! empty(trim($value)))->toArray();
    }
}
