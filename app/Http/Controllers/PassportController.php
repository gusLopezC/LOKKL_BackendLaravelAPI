<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PassportController extends Controller
{


    public function register(Request $request){
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];

        $this->validate($request, $rules);

        $datos = $request->all();
        $datos['password'] = bcrypt($request->password);
        $datos['verified'] = false;
        $datos['img'] = "profile.png";
        $datos['verification_token'] = User::generarToken();
        $usuario = User::create($datos);


        $token = $usuario->createToken('dadirugesedevalclkkol')->accessToken;

        return response()->json(['data' => $usuario,
        'token' => $token, 200]);
    }
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('dadirugesedevalclkkol')->accessToken;
            return response()->json(['token' => $token,'user' => auth()->user()], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
}
