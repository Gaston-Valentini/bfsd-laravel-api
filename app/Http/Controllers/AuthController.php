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
            'image' => 'max:255',
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
                    "image" => $request->input('image')
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
        try {
            //Validar el email
            $validator = Validator::make($request->all(), [
                'email' => 'required | email',
                'password' => 'required',
            ]);

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

            //Recuperar la información
            $email = $request->input('email');
            $password = $request->input('password');

            //Comprobamos y validamos si el usuario existe
            $user = User::query()->where('email', $email)->first();
            if (!$user) {
                throw new Error("Email or password incorrect.");
            }

            //Validamos la contraseña
            if (!Hash::check($password, $user->password)) {
                throw new Error("Email or password incorrect.");
            }
            //Creamos el token
            $token = $user->createToken('apiToken')->plainTextToken;

            //Devolvemos la información junto con el token
            return response()->json(
                [
                    "success" => true,
                    "message" => "User logged successfully",
                    "token" => $token,
                    "data" => $user
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            if($th->getMessage() === "Email or password incorrect.") {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or password incorrect."
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error user login."
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

    }
}

?>
