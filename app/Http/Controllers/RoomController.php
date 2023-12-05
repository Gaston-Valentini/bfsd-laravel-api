<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Room;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomController extends Controller
{
    //Recuperamos todas las salas
    public function getAllRooms (Request $request){

            $room = Room::all();

            if(count($room) == 0){
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Don't have rooms.",
                    ],
                    Response::HTTP_OK
                );
            } else {
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Get rooms successfully",
                        "data" => $room
                    ],
                    Response::HTTP_OK
                );
            }

    }

    //Recuperamos las salas que estén activas
    public function getRoomsActive (Request $request){

        $roomsActive = Room::where("is_active", true)
                        ->get();

        if(count($roomsActive) == 0){
            return response()->json(
                [
                    "success" => true,
                    "message" => "Currently there are no rooms that are active.",
                ],
                Response::HTTP_OK
            );
        } else{
            return response()->json(
                [
                    "success" => true,
                    "message" => "Get all rooms active.",
                    "data" => $roomsActive
                ],
                Response::HTTP_OK
            );
        }
    }

    //Recuperar una Room por el Id
    public function getRoomById ($id){
            try {
                //Recuperamos el id.
                $roomId = Room::query()->find($id);

                //Validamos si el usuario existe.
                if (!$roomId) {
                throw new Error("Room don't exist.");
                }

                //Devolvemos la información del usuario
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Room exist.",
                        "data" => $roomId
                    ],
                    Response::HTTP_OK
                );

            } catch (\Throwable $th) {
                Log::error($th->getMessage());

                return response()->json(
                    [
                        "success" => false,
                        "message" => "Room don't exist."
                    ],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );

            }
    }

    public function createRoom (Request $request){
        //1. Recuperamos la información del body.
        $game_id = $request->input('game_id');
        dd($game_id);
        $name = $request->input('name');
        $image_url = $request->input('image_url');
        $is_active = $request->input('is_active');
        //2. Validamos la información
        //3. Guardo los datos.
        $newRoom = Room::create(
        [
        "game_id"->$game_id,
        "name"->$name,
        "image_url"->$image_url,
        "is_active"->$is_active,
        ]
        );
        //4. Enviamos la respuesta.
        return response()->json(
            [
                "success" => true,
                "message" => "room created",
                "data" => $newRoom
            ],
            Response::HTTP_CREATED
        );
    }

    public function updateRoomById (Request $request){
        return response("update");
    }

    //Eliminar una Room
    public function deleteRoomById (Request $request, $id){
        try {
            //Comprobamos que Room existe
            $roomId = Room::query()->find($id);
            // print_r($roomId);
            // Validaciones y respuestas
            if(!$roomId){
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Room don't exist.",
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            $userId=auth()->id();
            if($roomId->user_id !==userId){
                return response()->json(
                    [
                        "success" => true,
                        "message" => "The room does not belong to you.",
                    ],
                    Response::HTTP_UNATHORIZED
                );
            }
            //Eliminar
            $roomDelete=destroy($id);
            print_r($roomDelete);
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
