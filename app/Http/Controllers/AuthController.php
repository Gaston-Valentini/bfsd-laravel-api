<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    public function register (Request $request){
        return response()->json(
            [
                "message" => "Ok"
            ],
            200
        );
    }
}

?>
