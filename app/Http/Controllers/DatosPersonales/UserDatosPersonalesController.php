<?php

namespace App\Http\Controllers\DatosPersonales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserDatosPersonales;
use Illuminate\Support\Facades\Storage;


class UserDatosPersonalesController extends Controller
{
    //
    public function index()
    {
        $datospersonales = UserDatosPersonales::all();
        return response()->json(['guia' => $datospersonales], 201);
    }

    public function show($id)
    {
        $datospersonales = UserDatosPersonales::where('user_id', '=', $id)
            ->get();

        return response()->json(['guia' => $datospersonales], 201);
    }

    public function guardarInfoPersonal(Request $request)
    {

        error_log($request);

        $datospersonales = UserDatosPersonales::where('user_id', '=', $request->user_id)
            ->first();

        if ($datospersonales) {
            $datospersonales->NameContactoEmergencia = $request->NameContactoEmergencia;
            $datospersonales->NumContactoEmergencia = $request->NumContactoEmergencia;
            $datospersonales->EmailContactoEmergencia = $request->EmailContactoEmergencia;

            $datospersonales->save();
            return response()->json(['datospersonales' => $datospersonales], 201);
        } else {

            $datospersonales = UserDatosPersonales::create([
                'NameContactoEmergencia' => $request->NameContactoEmergencia,
                'NumContactoEmergencia' => $request->NumContactoEmergencia,
                'EmailContactoEmergencia' => $request->EmailContactoEmergencia,
                'user_id' => $request->user_id
            ]);
        }

        return response()->json(['Datospersonales' => $datospersonales], 201);
    }

    public function updatePhotoValidacion(Request $request)
    {
        error_log($request->file('photo'));
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $name = time() . $file->getClientOriginalName();
            $filePath = '/images/validationUserDocumento/' . $name;

            Storage::disk('s3')->put($filePath, file_get_contents($file));

            $user = auth()->user();
            $user->archivovalidacion = $name;
            $user->save();

            $token = auth()->user()->createToken('dadirugesedevalclkkol')->accessToken;
            return response()->json(['token' => $token, 'user' => $user, 200]);
        } else {

            $user = auth()->user();
            $token = auth()->user()->createToken('dadirugesedevalclkkol')->accessToken;
            return response()->json(['token' => $token, 'user' => $user, 400]);
        }
    }

    public function updatePhotoValidacionApp(Request $request)
    {
        $image = $request->archivo;

        $image = str_replace('data:image/png;base64,', '', $image);

        $image = str_replace(' ', '+', $image);
        error_log($image);
        
        $imageName = str_random(10) . '.' . 'png';

        $filePath = '/images/validationUserDocumento/' . $imageName;

        Storage::disk('s3')->put($filePath, file_get_contents($image));

        $user = auth()->user();
        $user->archivovalidacion = $imageName;
        $user->save();

        $token = auth()->user()->createToken('dadirugesedevalclkkol')->accessToken;
        return response()->json(['token' => $token, 'user' => $user, 200]);
    }
}
