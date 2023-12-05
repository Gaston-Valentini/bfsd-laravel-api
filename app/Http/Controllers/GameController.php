<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{

    public function createGame(Request $request)
    {
        Log::info('Create Game');
        try {
            $userId=auth()->id();
            $name = $request->input('name');
            $description = $request->input('description');
            $image = $request->input('image');
            $newGame = Game::create([
                "user_id" => $userId,
                'name' => $name,
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
            dd($th);
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating message"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

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
            $game = Game::find($id)->get();

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

    private function validateDataGame(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'game_id' => 'min:1',
             'name' => 'min:3|max:50',
             "description" => 'min:3|max:255',
             'image_url' => 'max:255',
         ]);

         return $validator;
     }

    public function updateGame(Request $request, $id)
{
    try {
        
        $validator = $this->validateDataGame($request);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Error in the validation.",
                        "error" => $validator->errors()
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }
        $game = Game::find($id);

        if (!$game) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Game doesn't exist"
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        $name = $request->input('name');
        $description = $request->input('description');
        $image = $request->input('image');

        $game->name = $name;
        $game->description = $description;
        $game->image = $image;

        $game->save();

        return response()->json(
            [
                "success" => true,
                "message" => "Game updated",
                "data" => $game
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

public function deleteGame (Request $request, $id){
    try {
        //Comprobamos que Room existe
        $gameId = Game::query()->find($id);

        // Validaciones y respuestas
        if(!$gameId){
            return response()->json(
                [
                    "success" => true,
                    "message" => "Game don't exist.",
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $userId=auth()->id();
        if($gameId->user_id !==$userId){
            return response()->json(
                [
                    "success" => true,
                    "message" => "The game does not belong to you.",
                    "data"=> $gameId
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }
        //Eliminar
        $gameDeleted = $gameId->delete();
        print_r($gameDeleted);

        if ($gameDeleted) {
            return response()->json(
                [
                    "success" => true,
                    "message" => "Game deleted successfully.",
                ],
                Response::HTTP_OK
            );
        }

    } catch (\Throwable $th) {
        Log::error($th->getMessage());
    return response()->json(
        [
            "success" => false,
            "message" => "Error in delete."
        ],
        Response::HTTP_INTERNAL_SERVER_ERROR
    );
    }
}

}
