<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PassportController extends Controller
{
    public function prueba(Request $request)
    {
        return 'Hola Welcome';
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
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
            'token' => $token, 200,
        ]);
    }

    public function LoginGoogle(Request $request)
    {

        if ($busquedausuario = User::where('email', $request->email)->first()) {

            if ($busquedausuario->email == $request->email) {


                $token = $busquedausuario->createToken('dadirugesedevalclkkol')->accessToken;

                return response()->json([
                    'user' => $busquedausuario,
                    'token' => $token, 200,
                ]);
            }
        }


            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',

            ];

            $this->validate($request, $rules);

            $datos = $request->all();
            $datos['password'] = ':D';
            $datos['role'] = 'USER_ROLE';
            $datos['verified'] = false;
            $datos['img'] = $request->photoUrl;
            $datos['verification_token'] = User::generarToken();

            $usuario = User::create($datos);

            $token = $usuario->createToken('dadirugesedevalclkkol')->accessToken;

            // retry(5, function () use ($usuario) {
            //     Mail::to($usuario->email)->send(new UserCreated($usuario));
            // }, 100);

            return response()->json([
                'user' => $datos,
                'token' => $token, 200,
            ]);

    }

    public function login(Request $request)
    {

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('dadirugesedevalclkkol')->accessToken;
            return response()->json(['token' => $token, 'user' => auth()->user()], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised :('], 401);
        }
    }

    public function index()
    {
        $usuarios = User::all();

        //return view('usuarios.verusuarios', compact('usuarios'));
        return response()->json(['data' => $usuarios, 200]);
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
            'password' => 'min:6',
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
        // eror_log($request);

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
            return 'existe un error'+$e;
        }
    }
    public function verify($token)
    {

        $user = User::where('verification_token', $token)->firstOrFail();

        $user->verified = 1;
        $user->verification_token = null;

        $user->save();

        return redirect()->away('https://www.lokkl.com/');
    }

    public function resend(User $user)
    {

        if ($user->verified == '1') {
            return response()->json(['mensaje' => 'Este usuario ya a sido verifcado', 409]);
        }

        Mail::to($user)->send(new UserCreated($user));

        return redirect()->away('https://www.lokkl.com/');
    }

    public function changePassword(Request $request)
    {

        $request->validate = [
            'password' => 'required',
            'new_password' => 'required|string|min:6|different:password',
        ];

        if (Hash::check($request->password, auth()->user()->password) == false) {


            return response(['message' => 'Unauthorized Fail'], 401);
        }

        $user = auth()->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response([
            'message' => 'Your password has been updated successfully.',
        ], 200);

    }
}
