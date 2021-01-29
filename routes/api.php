<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Baliza;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BalizasController;


//Pagina de inicio


//Inicio de sesion, registro y cerrar sesion
Route::post("register", [UserController::class, "register"]);
Route::post("login", [UserController::class, "login"]);


//Solo entras si estas registrado
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('logout', [UserController::class, "logout"]);
});

//Muestra en JSON las balizas
Route::get('baliza', function() {
    return Baliza::all();
});

Route::get('baliza/{id}', function($id) {
    return Baliza::find($id);
});

//Guardar datos
// Route::post('/balizas', [BalizasController::class, "cogerBalizas"]);
// Route::post('/datosbalizas', [BalizasController::class, "cogerDatos"]);



//sanctum auth middleware routes
Route::middleware('auth:api')->group(function() {
    Route::get("user", [UserController::class, "user"]);
});