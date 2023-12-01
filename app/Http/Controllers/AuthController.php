<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    public function register (Request $request){
        return response()->json(
            [
                "message" => "Ok"
            ],
            Response::HTTP_OK
        );
    }
}

?>
