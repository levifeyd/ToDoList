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
        $user = User::query()->create([
            'name'=>'userA',
            'email' => 'userA@mail.ru',
            'password' => bcrypt('qweasdzxc'),
        ]);
        $user->assignRole('reader');

        $user = User::query()->create([
            'name'=>'userB',
            'email' => 'userB@mail.ru',
            'password' => bcrypt('qweasdzxc'),
        ]);
        $user->assignRole('editor');
    }
}
