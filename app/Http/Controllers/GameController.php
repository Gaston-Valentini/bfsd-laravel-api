<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    public function getAllGames(Request $request)
    {
        try {
            $games = Game::query()->get();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Get games successfully",
                    "data" => $games
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error gettin games"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function getGameById(Request $request, $id)
    {
        try {
            $game = Game::find($id)->user_id;

            return response()->json(
                [
                    "success" => true,
                    "message" => "Get game by user_id",
                    "data" => $game
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting game with courses"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function updateGameById(Request $request, $id)
    {
        try {
            $game = Game::query()->find($id);

            if (!$game) {
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Game doesnt exists"
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $name = $request->input('game');

            if ($request->has('game')) {
                $game->message = $name;
            }

            $game->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Game updated"
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error updating game"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function deleteGameById(Request $request, $id)
    {
        try {
            $deleteGame = Game::destroy($id);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Game deleted",
                    "data" => $deleteGame
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error deleting game by id"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function createGame(Request $request)
    {
        Log::info('Create Game');
        try {
            $name = $request->input('name');
            $description = $request->input('description');
            $image = $request->input('image');
            $newGame = Game::create([
                "name" => $name,
                "description" => $description,
                "image" => $image
            ]);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Game created",
                    "data" => $newGame
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating game"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }


        return 'Create Game';
    }
}
