<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller {

    //registro de usuario
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status_code" => 400, 
                'message' => 'Bad request'
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'status'=> 200, 
            'message'=> 'Usuario creado correctamente'
        ]);
    }

    //Inicio de sesion
    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status_code" => 400, 
                'message' => 'Bad request']);
        }

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)) {
            return reponse()->json([
                'status_code' => 500, 
                'message' => 'No autorizado'
            ]);
        }

        $user = User::where("email", $request->email)->first();

        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status_code' => 200, 
            'token' => $tokenResult
        ]);
    }

    //Cierre de sesión
    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status_code' => 200, 
            'message' => 'Token deleted successfully!'
        ]);
    }
}