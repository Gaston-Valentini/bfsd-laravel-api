<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
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
            dd($th);

            return response()->json(
                [
                    "success" => false,
                    "message" => "Users don't exist."
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );

        }
    }

    public function updateUserById (Request $request){
        return response("Update user");
    }

    public function deleteUserById (Request $request){
        return response("Delete user");
    }
}
