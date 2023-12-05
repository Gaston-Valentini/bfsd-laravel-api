<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Error;
use Illuminate\Support\Facades\Validator;
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

     //Validaciones
     private function validateDataRoom(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'game_id' => 'min:1',
             'name' => 'min:3|max:50',
             'image_url' => 'max:255',
         ]);

         return $validator;
     }

    public function updateRoomById (Request $request, $id){
        try {
            //Validar la información
            $validator = $this->validateDataRoom($request);

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
            //Recuperamos el id.
            $roomUpdate = Room::find($id);

            //Validamos si el id de usuario existe.
            if (!$roomUpdate) {
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Room don't exist."
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

            // Obtener todos los datos enviados por el usuario
            $roomData = $request->all();

            if($roomData !== []){
             foreach ($roomData as $key => $value) {
             if (property_exists($roomUpdate, $key) && $roomUpdate->$key !== $value) {
                 $roomUpdate->$key = $value;
             }
             }

             $roomUpdate->update($roomData);

              return response()->json(
             [
                 "success" => true,
                 "message" => "Actualizado.",
                 "data" => $roomUpdate
             ],
             Response::HTTP_OK
              );

             } else {
             return response()->json(
                 [
                     "success" => true,
                     "message" => "Field empty."
                 ],
                 Response::HTTP_BAD_REQUEST
             );
            }

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

        return response()->json(
            [
                "success" => false,
                "message" => "Error in update room."
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
        }
    }

    //Eliminar una Room
    public function deleteRoomById (Request $request, $id){
        try {
            //Comprobamos que Room existe
            $roomId = Room::query()->find($id);

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
            if($roomId->user_id !==$userId){
                return response()->json(
                    [
                        "success" => true,
                        "message" => "The room does not belong to you.",
                        "data"=> $roomId
                    ],
                    Response::HTTP_UNAUTHORIZED
                );
            }
            //Eliminar
            $roomDelete = $roomId->delete();
            print_r($roomDelete);

            if ($roomDelete) {
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Room deleted successfully.",
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
