<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    public function getAllMessages(Request $request)
    {
        try {
            $messages = Game::query()->get();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Get message successfully",
                    "data" => $messages
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error gettin messages"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function getMessageById(Request $request, $id)
    {
        try {
            $messages = Game::find($id)->user_id;

            return response()->json(
                [
                    "success" => true,
                    "message" => "Get message by user_id",
                    "data" => $messages
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting user with courses"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function updateMessageById(Request $request, $id)
    {
        try {
            $messages = Game::query()->find($id);

            if (!$messages) {
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Message doesnt exists"
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $name = $request->input('message');

            if ($request->has('message')) {
                $messages->message = $name;
            }

            $messages->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Message updated"
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error updating message"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function deleteMessageById(Request $request, $id)
    {
        try {
            $deleteMessage = Game::destroy($id);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Message deleted",
                    "data" => $deleteMessage
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error deleting message by id"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function createMessage(Request $request)
    {
        Log::info('Create Message');
        try {
            $messages = $request->input('message');
            $newMessage = Game::create([
                'message' => $messages,
            ]);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Message created",
                    "data" => $newMessage
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating message"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }


        return 'Create Message';
    }
}
