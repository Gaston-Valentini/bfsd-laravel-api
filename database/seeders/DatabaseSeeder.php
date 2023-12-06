<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'name' => Str::random(30),
                "surname" => Str::random(30),
                "nickname" => Str::random(30),
                'email' => 'user@user.com',
                'password' => Hash::make('password'),
            ]
        );

        DB::table('users')->insert(
            [
                'name' => Str::random(2),
                "surname" => Str::random(2),
                "nickname" => Str::random(2),
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'role' => "admin"
            ]
        );

        DB::table('games')->insert(
            [
                'name' => Str::random(10),
                'description' => Str::random(10),
            ]
        );

        DB::table('rooms')->insert(
            [
                'name' => Str::random(5),
            ]
        );

        DB::table('message')->insert(
            [
                'message' => Str::random(100),
            ]
        );
    }
}

