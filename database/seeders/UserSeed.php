<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
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
                'name'           => 'admin',
                'email'          => 'admin@example.com',
                'password'       => bcrypt('123'),
                'notelp'         => '0812345678',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
