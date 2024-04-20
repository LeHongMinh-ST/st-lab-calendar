<?php

namespace App\Livewire\Team;

use Livewire\Attributes\Validate;
use Livewire\Component;

class TeamCreate extends Component
{
    #[Validate(as: 'tên nhóm')]
    public string $name = '';

    #[Validate(as: 'hinh ảnh')]
    public string $thumbnail = '';

    #[Validate(as: 'mô tả')]
    public string $desciption = '';

    #[Validate(as: 'trưởng nhóm')]
    public string $userName = '';

    #[Validate(as: 'trạng thái')]
    public string $status = '';

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'unique:users,username',
            ],
            'description' => [
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

    public function render()
    {
        return view('livewire.team.team-create');
    }
}
