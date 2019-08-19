<?php

namespace App\Http\Controllers\Prospectos;

use App\Http\Controllers\Controller;
use App\Mail\ProspectoAcept;

use App\ProspectosGuide;
use App\User;
use App\Guias;
use Mail;
use Illuminate\Http\Request;

class ProspectosGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prospectos = ProspectosGuide::all();
        //return $prospecto;
        return view('prospectos.verprospectos', compact('prospectos'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:prospectos_guides',
        ];
        $this->validate($request, $rules);

        $waypoints = implode(",", $request->idiomas);

        $data = $request->all();
        $data['idiomas'] = $waypoints;
        $data['estado'] = 'Nuevo';
        $prospecto = ProspectosGuide::create($data);

        return response()->json(['data' => $prospecto], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prospecto = ProspectosGuide::findOrFail($id);

        return view('prospectos.detallesprospecto', compact('prospecto'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prospecto = ProspectosGuide::findOrFail($id);
        return $prospecto;
        $prospecto->delete();

        $files = array($file1, $file2);
File::delete($files);

        return redirect('/prospectos');
    }

    public function updateDocument(Request $request)
    {
        $campo = $request->campo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $name = $campo . time() . $file->getClientOriginalName();

            $file->move(public_path() . '/images/documents', $name);
        }

        //Image::make($file)->fit(144, 144)->save($path);

        $user = auth()->user();
        $prospecto = ProspectosGuide::where('user_id', $user->id)->first();
        $prospecto->$campo = $name;
        $prospecto->save();

        $token = auth()->user()->createToken('dadirugesedevalclkkol')->accessToken;
        return response()->json(['token' => $token, 'user' => '$prospecto', 200]);
    }

    /* ========================
    Metodo para solicitar documentos esta en MailController
    ======================== */
/**
 * Este  Metodo manda un correo al prospecto diciendole que a sido aceptado
 * cambiamos el role del usuario a GUIDE_VERIFIED para que pueda comenzar a crear tours
 * y ademas registrarlo en la table de guias
 */
    public function AceptarProspecto($prospectos)
    {

        $prospectos = ProspectosGuide::findOrFail($prospectos);

        $prospectos->estado = "Aceptado";
        $prospectos->save();
        Mail::to($prospectos)->send(new ProspectoAcept($prospectos));


        $user = auth()->user();
        $user->role = 'GUIDE_VERIFIQUED';
        $user->save();

       $guias = Guias::create($user);

       return response()->json(['Guia nuevo' => $guias], 201);

    }
}
