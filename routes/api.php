<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Healthcheck Route
Route::get('/', function (Request $request) {
    return response()->json(
        [
            "success" => true,
            "message" => "Healthcheck ok"
        ],
        Response::HTTP_OK //code status 200
    );
});

Route::post('/register', [AuthController::class, 'register']);

//CRUD ROOMS
Route::get('/room', [RoomController::class, 'getAllRooms']);
Route::get('/room/{id}', [RoomController::class, 'getRoomById']);
Route::post('/room', [RoomController::class, 'createRoom']);
Route::put('/room/{id}', [RoomController::class, 'updateRoomById']);
Route::delete('/room/{id}', [RoomController::class, 'deleteRoomById']);

//CRUD MESSAGES
Route::get('/messages', [MessageController::class, 'getAllMessages']);
Route::get('/message/{id}', [MessageController::class, 'getMessageById']);
Route::post('/createMessage', [MessageController::class, 'createMessage']);
Route::put('/updatemessage/{id}', [MessageController::class, 'updateMessageById']);
Route::delete('/deletemessage/{id}', [MessageController::class, 'deleteMessageById']);