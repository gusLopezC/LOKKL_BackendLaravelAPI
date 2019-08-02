<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PassportController extends Controller
{


    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];

        $this->validate($request, $rules);

        $datos = $request->all();
        $datos['password'] = bcrypt($request->password);
        $datos['verified'] = false;
        $datos['img'] = 'avatar3.png';
        $datos['verification_token'] = User::generarToken();

        $usuario = User::create($datos);


        $token = $usuario->createToken('dadirugesedevalclkkol')->accessToken;

        return response()->json([
            'data' => $usuario,
            'token' => $token, 200
        ]);
    }
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('dadirugesedevalclkkol')->accessToken;
            return response()->json(['token' => $token, 'user' => auth()->user()], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }


    public function index()
    {
        $usuarios = User::all();

        return view('usuarios.verusuarios', compact('usuarios'));
    }

    public function show($id)
    {

        $usuarios = User::findOrFail($id);

        return response()->json(['data' => $usuarios, 200]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $rules = [

            'email' => 'email',
            'password' => 'min:6'
        ];


        $this->validate($request, $rules);

        $user->name = $request->name;
        $user->telephone = $request->telephone;
        $user->infopersonal = $request->infopersonal;
        $user->email = $request->email;

        if (!$user->isDirty()) {

            return response()->json(['error' =>
            'Se debe especificar un campo al menos para actualizar', 'code' => 422], 422);
        }
        $user->save();

        $token = auth()->user()->createToken('dadirugesedevalclkkol')->accessToken;
        return response()->json(['token' => $token, 'user' => $user, 200]);
    }

    public function updatePhoto(Request $request)
    {

        $this->validate($request, [
            'photo' => 'required|image'
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/images/profile', $name);
        }

        // Image::make($file)->fit(144, 144)->save($path);

        $user = auth()->user();
        $user->img = $name;
        $user->save();

        $token = auth()->user()->createToken('dadirugesedevalclkkol')->accessToken;
        return response()->json(['token' => $token, 'user' => $user, 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['data' => $user, 200]);
        } catch (PDOException $e) {
            return 'existe un error' + $e;
        }
    }
}
