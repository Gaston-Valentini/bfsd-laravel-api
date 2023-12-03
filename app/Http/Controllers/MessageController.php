<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{


    public function getAllMessages(Request $request)
    {
        try {
            $messages = Message::query()->get();
                
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
            $messages = Message::find($id)->user_id;

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

    

}

