<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Baliza;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BalizasController;


//Inicio de sesion, registro y cerrar sesion
Route::post("register", [UserController::class, "register"]);
Route::post("login", [UserController::class, "login"]);

//Solo entras si estas registrado
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('logout', [UserController::class, "logout"]);
});


//Muestra el JSON con las balizas guardadas en la bd
Route::get('baliza', function() {
    return Baliza::all();
});

//Muestra el JSON con la baliza indicada
Route::get('baliza/{id}', function($id) {
    return Baliza::find($id);
});


//Guardar datos
Route::get('/balizas', [BalizasController::class, "balizas"]);
Route::get('/datosBalizas', [BalizasController::class, "datos"]);




//sanctum auth middleware routes
Route::middleware('auth:api')->group(function() {
    Route::get("user", [UserController::class, "user"]);
});