<?php

namespace App\Http\Controllers;
use App\Models\Room;
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

    public function getRoomById (Request $request, $id){
        return response("by id");
    }

    public function createRoom (Request $request){
        //1. Recuperamos la información del body.
        $game_id = $request->input('game_id');
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

    public function deleteRoomById (Request $request){
        return response("delete room");
    }
}
