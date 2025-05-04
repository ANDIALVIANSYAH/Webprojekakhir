<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeederUser extends Seeder
{
    public function run(): void
    {
        DB::table('users_007')->insert([
            [
                'name' => 'AndiAlviasnyah.S',
                'email' => 'andialviansyah@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'mingyu',
                'email' => 'gyuuu@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'Receptionist',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jeno',
                'email' => 'jeno@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'Customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
