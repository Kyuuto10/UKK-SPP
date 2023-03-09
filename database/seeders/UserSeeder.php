<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

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
               'name'=>'Siswa',
               'username'=>'siswa123',
               'type'=>0,
               'password'=> bcrypt('siswa123'),
            ],
            [
               'name'=>'Admin',
               'username'=>'admin123',
               'type'=>1,
               'password'=> bcrypt('admin123'),
            ],
            [
               'name'=>'Petugas',
               'username'=>'petugas123',
               'type'=> 2,
               'password'=> bcrypt('petugas123'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
