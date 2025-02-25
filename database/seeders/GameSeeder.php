<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role','Admin')->first();
        $user = User::where('role','User')->first();

        Game::create([
            'title' => 'The Witcher 3: Wild Hunt',
            'description' => 'You are Geralt of Rivia, mercenary monster slayer. Before you stands a war-torn, monster-infested continent you can explore at will.
            Your current contract? Tracking down Ciri — the Child of Prophecy, a living weapon that can alter the shape of the world.',
            'release_date' => '2015-05-18',
            'genre' => 'rpg',
            'user_id' => $admin->id
        ]);

        Game::create([
            'title' => 'Grand Theft Auto: San Andreas',
            'description' => 'Grand Theft Auto: San Andreas: It’s the early ’90s.
            After a couple of cops frame him for homicide, Carl ‘CJ’ Johnson is forced on a journey that takes him across the entire state of San Andreas, to save his family and to take control of the streets.',
            'release_date' => '2023-01-19',
            'genre' => 'open-world',
            'user_id' => $admin->id
        ]);


        Game::create([
            'title' => 'The Last of Us Part I',
            'description' => 'Discover the award-winning game that inspired the critically acclaimed television show.
            Guide Joel and Ellie through a post-apocalyptic America, and encounter unforgettable allies and enemies in The Last of Us',
            'release_date' => '2023-03-28',
            'genre' => 'shooter',
            'user_id' => $user->id
        ]);

        Game::create([
            'title' => 'Silent Hill 2',
            'description' => 'Investigating a letter from his late wife, James returns to where they made so many memories - Silent Hill.
            What he finds is a ghost town, prowled by disturbing monsters and cloaked in deep fog.
            Confront the monsters, solve puzzles, and search for traces of your wife in this remake of SILENT HILL 2.',
            'release_date' => '2024-10-8',
            'genre' => 'horror',
            'user_id' => $user->id
        ]);
    }
}
