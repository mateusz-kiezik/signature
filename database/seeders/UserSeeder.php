<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'position' => 'Administrator',
                'department_id' => 1,
                'email' => 'admin@rl',
                'password' => 'password',
                'role_id' => 2,
                'status' => 1
            ],
            [
                'name' => 'Adam Kowalski',
                'position' => 'Spedytor Międzynarodowy',
                'position_en' => 'International Freight Forwarder',
                'phone' => '0048 71 752 41 44',
                'mobile' => '0048 557 771 444',
                'wechat' => 'AdamSpedytor',
                'department_id' => 1,
                'email' => 'adam@test',
                'password' => 'password',
                'role_id' => 1,
                'status' => 1
            ],
            [
                'name' => 'Damian Malinowski',
                'position' => 'Spedytor Krajowy',
                'position_en' => 'Freight Forwarder',
                'phone' => '0048 71 754 22 11',
                'mobile' => '0048 588 554 221',
                'wechat' => 'DamianPL',
                'department_id' => 4,
                'email' => 'damian@test',
                'password' => 'password',
                'role_id' => 1,
                'status' => 1
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
