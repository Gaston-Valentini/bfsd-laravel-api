<?php

namespace App\Http\Controllers;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    //CRUD USER
    public function getAllUsers (Request $request){
        return response("all users");
    }

    public function getUserById (Request $request){
        return response("User by id");
    }

    public function updateUserById (Request $request){
        return response("Update user");
    }

    public function deleteUserById (Request $request){
        return response("Delete user");
    }
}
