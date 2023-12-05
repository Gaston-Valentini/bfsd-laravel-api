<?php

namespace App\Http\Controllers;
use App\Models\User;
use Error;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    //Validaciones
     private function validateDataUser(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'name' => 'min:3|max:50',
             'surname' => 'min:3|max:50',
            //  'nickname' => 'unique:users|min:3|max:50',
             'email' => 'unique:users|email|max:50',
             'password' => 'min:6|max:12',
             'image' => 'max:255',
         ]);

         return $validator;
     }

     //CRUD USER
    // Recuperar a todos los usuarios
    public function getAllUsers (Request $request){
        $users = User::all();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Get all users.",
                    "data" => $users
                ],
                Response::HTTP_OK
            );
    }

    //Recuperar la información de un usuario por el Id.
    public function getUserById (Request $request, $id){
        try {
            //Recuperamos el id.
            $userId = User::query()->find($id);

            //Validamos si el usuario existe.
            if (!$userId) {
            throw new Error("Users don't exist.");
            }

            //Devolvemos la información del usuario
            return response()->json(
                [
                    "success" => true,
                    "message" => "User exist.",
                    "data" => $userId
                ],
                Response::HTTP_OK
            );

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Users don't exist."
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );

        }
    }

    //Actualizar la información de un usuario por el Id.
    public function updateUserById (Request $request, $id){
        try {
            //Validar la información
            $validator = $this->validateDataUser($request);

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
            $userUpdate = User::query()->find($id);

            //Validamos si el id de usuario existe.
            if (!$userUpdate) {
                return response()->json(
                    [
                        "success" => true,
                        "message" => "User don't exist."
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

        // Obtener todos los datos enviados por el usuario
        $userData = $request->all();
        dump($userData);

        if($userData !== []){
            foreach ($userData as $key => $value) {
            if (property_exists($userUpdate, $key) && $userUpdate->$key !== $value) {
                $userUpdate->$key = $value;
            }
            }

            $userUpdate->update($userData);

            return response()->json(
            [
                "success" => true,
                "message" => "Actualizado.",
                "data" => $userUpdate
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
                    "message" => "Error in update user."
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    //Eliminar un usuario por el Id
    public function deleteUserById (Request $request, $id){
        try {

            $userDelete = User::destroy($id);
            dump($userDelete);


        } catch (\Throwable $th) {
            Log::error($th->getMessage());

        return response()->json(
            [
                "success" => false,
                "message" => "Error in delete user."
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
        }
    }
}
