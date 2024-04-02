<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ProfileUpdate extends Component
{
    public mixed $userId = null;

    #[Validate(as: 'Tên tài khoản')]
    public string $username = '';

    #[Validate(as: 'Họ và tên')]
    public string $full_name = '';

    #[Validate(as: 'Email')]
    public string $email = '';

    #[Validate(as: 'Số điện thoại')]
    public string $phone_number = '';

    public function rules(): array
    {
        return [
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
                    if (!preg_match("/^[0-9]{10}$/", $value)) {
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

    public function updateInfo()
    {
        $this->validate();
        $payload = [
            'username' => $this->username,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
        ];

        try {
            User::where('id', $this->userId)->update($payload);
            $this->dispatch('alert', type: 'success', message: 'Cập nhật thành công!');
        } catch (\Exception $e) {
            Log::error('Error update user', [
                'method' => __METHOD__,
                'message' => $e->getMessage()
            ]);
            $this->dispatch('alert', type: 'error', message: 'Cập nhật thất bại!');
        }
    }
}
