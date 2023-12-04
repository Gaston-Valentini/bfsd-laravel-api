<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Routing\Controller;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //Validaciones
    private function validateDataUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'surname' => 'required|min:3|max:50',
            'nickname' => 'required|unique:users|min:3|max:50',
            'email' => 'required|unique:users|email|max:50',
            'password' => 'required|min:6|max:12',
        ]);

        return $validator;
    }

    //Registro
    public function register (Request $request){
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

            //Guardamos los datos que recuperamos del body y los tratamos.
            $newUser = User::create(
                [
                    "name" => $request->input('name'),
                    "surname" => $request->input('surname'),
                    "nickname" => $request->input('nickname'),
                    "email" => $request->input('email'),
                    "password" => bcrypt($request->input('password')),
                ]
            );

            //Email de bienvenida
            //TODO

            //Devolver una respuesta
            return response()->json(
                [
                    "success" => true,
                    "message" => "User registered successfully.",
                    "data" => $newUser
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            dd($th);
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error registering user"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );        }

    }

    //Login
    public function login (Request $request){
        //Validar el email
        $validator = Validator::make($request->all(), [
            'email' => 'required | email',
            'password' => 'required',
        ]);

        //Recuperar la información

        //Validamos si el usuario existe

        //Validamos la contraseña

        //Creamos el token

        //Devolvemos la información junto con el token
        return response()->json(
            [
                "message" => "Ok"
            ],
            Response::HTTP_OK
        );
    }
}

?>
