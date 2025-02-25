<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    private const VALID_GENRES = [
        'action', 'adventure', 'rpg', 'shooter', 'strategy', 'simulation',
        'horror', 'puzzle', 'racing', 'fighting', 'sports', 'platformer',
        'open-world', 'stealth', 'survival', 'battle royale', 'metroidvania',
        'roguelike', 'mmo', 'sandbox'
    ];

    public function read(Request $request): JsonResponse
    {
        $user = $request->user();

        $query = Game::where('user_id', $user->id);

        $genre = $request->query('genre');
        if ($genre) {
            $query = $query->where('genre', $genre);
        }

        $orderByReleaseDate = $request->query('order-by-date');
        if($orderByReleaseDate == 'asc' || $orderByReleaseDate == 'desc') {
            $query = $query->orderBy('release_date',$orderByReleaseDate);
        }

        return response()->json([
            'data' => $query->get()
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $gameData = $request->validate
        ([
            'title' => 'string|required',
            'description' => 'string|required',
            'release_date' => 'date|required',
            'genre' => 'string|required|in:' . implode(',', self::VALID_GENRES)
        ]);

        $user = $request->user();

        $game = Game::create
        ([
            'title' => $gameData['title'],
            'description' => $gameData['description'],
            'release_date' => $gameData['release_date'],
            'genre' => $gameData['genre'],
            'user_id' => $user->id
        ]);

        return response()->json
        ([
            'message' => 'Game Created',
            'data' => $game
        ], 201);

    }

    public function update(Request $request): JsonResponse
    {
        $gameData = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'release_date' => 'date',
            'genre' => 'string|in:' . implode(',', self::VALID_GENRES)
        ]);

        $gameId = $request->route()->parameter('id');

        $game = Game::find($gameId);

        if (!$game) {
            return response()->json([
                'message' => 'Game does not exist'
            ], 404);
        }

        $game->update($gameData);
        $game->save();

        return response()->json
        ([
            'message' => 'Game Updated',
            'data' => $game
        ]);
    }

    public function delete(Request $request)
    {
        $gameId = $request->route()->parameter('id');

        $game = Game::find($gameId);

        if (!$game) {
            return response()->json([
                'message' => 'Game doesnt exist'
            ], 404);
        }

        $game->delete();

        return response()->json([
            'message' => 'Game deleted',
            'data' => $game
        ]);

    }

}
