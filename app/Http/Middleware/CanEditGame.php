<?php

namespace App\Http\Middleware;

use App\Models\Game;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanEditGame
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $userRole = $user->role;
        $userId = $user->id;

        if ($userRole == 'Admin') {
            return $next($request);
        }

        $gameId = $request->route()->parameter('id');
        $game = Game::find($gameId);

        if (!$game) {
            return response()->json([
                'message' => 'Game not found'
            ],404);
        }

        $ownerId = $game->user_id;

        if ($userId !== $ownerId ) {
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }

        return $next($request);
    }
}
