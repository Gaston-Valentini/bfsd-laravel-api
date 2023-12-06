<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GameController;


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

//AUTH ROUTES
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

//CRUD USER
Route::group([
        "middleware" => [
            "auth:sanctum"
        ]
    ], function () {
    Route::get('/user/{id}', [UserController::class, 'getUserById']);
    Route::put('/user/{id}', [UserController::class, 'updateUserById']);
});


//CRUD ROOMS
Route::group([
    "middleware" => [
        "auth:sanctum"
    ]
], function () {
    Route::get('/room', [RoomController::class, 'getAllRooms']);
    Route::get('/room/{id}', [RoomController::class, 'getRoomById']);
    Route::post('/room', [RoomController::class, 'createRoom']);
    Route::put('/room/{id}', [RoomController::class, 'updateRoomById']);
    Route::delete('/room/{id}', [RoomController::class, 'deleteRoomById']);
});


//CRUD MESSAGES
Route::group([
    "middleware" => [
        "auth:sanctum"
    ]
], function () {
    Route::get('/messages', [MessageController::class, 'getAllMessages']);
    Route::get('/message/{id}', [MessageController::class, 'getMessageById']);
    Route::post('/createMessage', [MessageController::class, 'createMessage']);
    Route::put('/updatemessage/{id}', [MessageController::class, 'updateMessageById']);
    Route::delete('/deletemessage/{id}', [MessageController::class, 'deleteMessageById']);
});

//CRUD GAMES
Route::group([
    "middleware" => [
        "auth:sanctum"
    ]
], function () {
    Route::get('/games', [GameController::class, 'getAllGames']);
    Route::post('/createGame', [GameController::class, 'createGame']);
    Route::get('/getGameById/{id}', [GameController::class, 'getGameById']);
    Route::post('/updateGameById/{id}', [GameController::class, 'updateGame']);
    Route::delete('/deleteGame/{id}', [GameController::class, 'deleteGame']);
});

// ADMIN
Route::group([
    "middleware" => [
        "auth:sanctum",
        "is_admin"
    ]
], function () {
    Route::get('/user', [UserController::class, 'getAllUsers']);
    Route::delete('/user/{id}', [UserController::class, 'deleteUserById']);
});
