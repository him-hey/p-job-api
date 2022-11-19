<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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
            ['name' => 'Bopha', 'gender' => 'Male', 'phone' => '09784966', 'profile' => 'profile.png', 'email' => 'bopha@gmail.com', 'password' => Hash::make('password')],
            ['name' => 'Chompa', 'gender' => 'Male', 'phone' => '09784966', 'profile' => 'profile.png', 'email' => 'Chompa@gmail.com', 'password' => Hash::make('password')],
            ['name' => 'Romdul', 'gender' => 'Male', 'phone' => '09784966', 'profile' => 'profile.png', 'email' => 'Romdul@gmail.com', 'password' => Hash::make('password')],
            ['name' => 'Serey', 'gender' => 'Male', 'phone' => '09784966', 'profile' => 'profile.png', 'email' => 'Serey@gmail.com', 'password' => Hash::make('password')],
            ['name' => 'Susdey', 'gender' => 'Male', 'phone' => '09784966', 'profile' => 'profile.png', 'email' => 'Susdey@gmail.com', 'password' => Hash::make('password')],
            ['name' => 'Lysa', 'gender' => 'Male', 'phone' => '09784966', 'profile' => 'profile.png', 'email' => 'Lysa@gmail.com', 'password' => Hash::make('password')],
            ['name' => 'borith', 'gender' => 'Male', 'phone' => '09784966', 'profile' => 'profile.png', 'email' => 'borith@gmail.com', 'password' => Hash::make('password')],
        ];
        //
        DB::table('users')->insert($users);
    }
}
