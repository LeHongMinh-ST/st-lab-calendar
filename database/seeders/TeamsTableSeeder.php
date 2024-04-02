<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'admin')->first();

        if ($user) {
            $team = Team::where('name', 'Super Admin')->first();
            if (empty($team)) {
                Team::create([
                    'name' => 'ST TEAM',
                    'user_id' => $user->id,
                    'status' => Status::Active,
                ]);
            }
        }
    }
}
