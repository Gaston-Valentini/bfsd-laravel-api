<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Nette\Schema\Message;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    public function getAllMessages(Request $request)
    {
        try {
            $messages = Message::query()
                ->where('is_active', true)
                ->get(['id','user_id','room_id', 'message']);


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
}
