<?php

declare(strict_types=1);

namespace App\Livewire\Profile;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ProfileUpdate extends Component
{
    public mixed $userId = null;

    public string $avatar = '';

    #[Validate(as: 'tên tài khoản')]
    public string $username = '';

    #[Validate(as: 'họ và tên')]
    public string $full_name = '';

    #[Validate(as: 'email')]
    public string $email = '';

    #[Validate(as: 'số điện thoại')]
    public string $phone_number = '';

    #[Validate(as: 'mật khẩu cũ')]
    public string $old_password = '';

    #[Validate(as: 'mật khẩu mới')]
    public string $new_password = '';

    #[Validate(as: 'mật khẩu nhập lại')]
    public string $retyped_password = '';


    public function rules(): array
    {
        return [
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'username' => [
                'required',
                'unique:users,username,' . $this->userId . ',id'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $this->userId . ',id'
            ],
            'full_name' => 'required',
            'phone_number' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ( ! preg_match("/^[0-9]{10}$/", $value)) {
                        return $fail('Số điện thoại chưa đúng định dạng ');
                    }
                }
            ],
        ];
    }
    public function render()
    {
        $this->userId = auth()->id();
        $user = User::find($this->userId);
        $this->username = $user->username ?? '';
        $this->full_name = $user->full_name ?? '';
        $this->email = $user->email ?? '';
        $this->phone_number = $user->phone_number ?? '';
        return view('livewire.profile.profile-update');
    }

    public function updateInfo(): void
    {
        $this->validate();
        $payload = [
            'avatar' => $this->avatar,
            'username' => $this->username,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
        ];

        try {
            User::where('id', $this->userId)->update($payload);
            $this->dispatch('alert', type: 'success', message: 'Cập nhật thành công!');
        } catch (Exception $e) {
            Log::error('Error update user', [
                'method' => __METHOD__,
                'message' => $e->getMessage()
            ]);
            $this->dispatch('alert', type: 'error', message: 'Cập nhật thất bại!');
        }
    }

    public function updatePassword(): void
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'retyped_password' => 'required|same:new_password',
        ]);
    }
}
