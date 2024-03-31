<?php

namespace App\Livewire\User;

use App\Enums\Role;
use App\Enums\Status;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserCreate extends Component
{
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
        return [
            'username' => [
                'required',
                'unique:users,username',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'full_name' => 'required',
            'phone_number' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!preg_match("/^[0-9]{10}$/", $value)) {
                        return $fail('số điện thoại chưa đúng định dạng ');
                    }
                }
            ],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
            'role' => 'required',
            'status' => 'required',
        ];
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.user.user-create')->with([
            'roles' => Role::displayAll(),
            'statuses' => Status::displayAll(),
        ]);
    }

    public function submit()
    {
        $this->validate();

        // store
        try {
            User::create([
                'full_name' => $this->full_name,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'username' => $this->username,
                'password' => $this->password,
                'role' => $this->role,
                'status' => $this->status
            ]);

            $this->dispatch('alert', type: 'success', message: 'Tạo mới thành công!');
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            \Log::error('Error create user', [
                'method' => __METHOD__,
                'message' => $e->getMessage()
            ]);
            $this->dispatch('alert', type: 'success', message: 'Tạo mới thất bại!');
        }
    }
}
