<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = DB::table('users')->insert(
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

        $game = DB::table('games')->insert(
            [
                "user_id" => $user,
                'name' => Str::random(10),
                'description' => Str::random(10),
            ]
        );

        $room = DB::table('rooms')->insert(
            [
                "user_id" => $user,
                "game_id" => $game,
                'name' => Str::random(5),
            ]
        );

        DB::table('messages')->insert(
            [
                "user_id" => $user,
                "room_id" => $room,
                'message' => Str::random(100),
            ]
        );
    }
}

