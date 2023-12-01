<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomController extends Controller
{
    public function getAllRooms (Request $request){
        return response("all");
    }

    public function getRoomById (Request $request){
        return response("by id");
    }

    public function createRoom (Request $request){
        return response("create room");
    }

    public function updateRoom (Request $request){
        return response("update");
    }

    public function deleteRoomById (Request $request){
        return response("delete room");
    }
}
