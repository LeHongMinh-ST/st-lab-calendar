<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::checkIssetBeforeCreate([
            'username' => 'admin',
            'full_name' => 'Super Admin',
            'email' => 'superadmin@st.vn',
            'is_admin' => 1,
            'password' => '123456aA@',
        ]);
    }

    private function checkIssetBeforeCreate($data): void
    {
        $admin = User::where('email', $data['email'])->first();
        if (empty($admin)) {
            User::create($data);
        } else {
            $admin->update($data);
        }
    }
}
