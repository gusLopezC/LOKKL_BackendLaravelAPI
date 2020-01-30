<?php

namespace App\Http\Controllers\Prospectos;

use App\Guias;
use App\ProspectosGuide;
use App\User;

use App\Http\Controllers\Controller;
use App\Mail\Prospectos\NewProspectRegister;
use App\Mail\Prospectos\ProspectoAcept;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mail;

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
            'nameContacto' => 'required',
            'emailContacto' => 'required|email|unique:prospectos_guides',
        ];
        $this->validate($request, $rules);


        $data = $request->all();
        $data['estado'] = 'Nuevo';
        $prospecto = ProspectosGuide::create($data);

        //Mail::to('iam@lokkl.com')
        //   ->cc(['developerlokkl@gmail.com', 'lokklmx@gmail.com'])
        //    ->send(new NewProspectRegister($prospecto));

        return response()->json(['data' => $prospecto], 201);
    }

    public function registrarProspectoEmpresa(Request $request)
    {
        error_log($request);
        error_log($request->ciudad);
        $rules = [
            'nameempresa' => 'required',
            'emailContacto' => 'required|email|unique:prospectos_guides',
        ];
        $this->validate($request, $rules);

        $guia = ProspectosGuide::create([

            'TipoProspecto' => $request->TipoProspecto,
            'nameContacto' => $request->nameempresa,
            'emailContacto'=> $request->emailContacto,
            'telefonoContacto' => $request->telefono,
            'edad'  =>  null,
            'ciudad' => $request->ciudad,
            'preguntasGuia'  =>  null,
            'comoNosConociste'  =>  null,
            'document_identificacion' => null,
            'document_comprobantedomicilio'  => null,
            'document_cedulafiscal' => null,
            'document_certificacion' => null,
            'estado' => 'Nuevo',
            'nameempresa' => $request->nameempresa,
            'nombreempresaLegal' => $request->nombreempresaLegal,
            'sitioweb' => $request->sitioweb,
            'DireccionCompletaEmpresa' => $request->ciudadContacto . ',' . $request->CP . ',' . $request->dirección,
            'ContactoCompletoEmpresa' => $request->nombreContacto . ',' . $request->puestoTrabajo . ',' . $request->telefonocontacto,
            'user_id' => $request->user_id
        ]);

        // Mail::to('iam@lokkl.com')
        //     ->cc(['developerlokkl@gmail.com', 'lokklmx@gmail.com'])
        //     ->send(new NewProspectRegister($prospecto));

         return response()->json(['Prospecto' => $guia], 201);
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
        $prospecto->delete();
        //TODO:Falta eliminar de aws imagenes
        //$files = array($file1, $file2);
        //File::delete($files);

        return redirect('/prospectos');
    }

    public function updateDocument(Request $request)
    {
        $campo = $request->campo;
        $iduser = $request->iduser;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $name = $campo . time() . $file->getClientOriginalName();
            $filePath = '/images/documents/' . $name;

            Storage::disk('s3')->put($filePath, file_get_contents($file));
        }

        //Image::make($file)->fit(144, 144)->save($path);


        $prospecto = ProspectosGuide::where('user_id', $iduser)->first();
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
        //Mail::to($prospectos)->send(new ProspectoAcept($prospectos));

        $user = User::where('id', $prospectos->user_id)->first();

        $user->role = 'GUIDE_VERIFIQUED';
        $user->save();

        $guias = Guias::create([

            'TipoGuia' => $prospectos->TipoProspecto,
            'name' => $prospectos->nameContacto,
            'email' => $prospectos->emailContacto,
            'telefono' => $prospectos->telefonoContacto,
            'edad' => $prospectos->edad,
            'ciudad' => $prospectos->ciudad,
            'document_identificacion' => $prospectos->document_identificacion,
            'document_comprobantedomicilio' => $prospectos->document_comprobantedomicilio,
            'document_cedulafiscal' => $prospectos->document_cedulafiscal,
            'document_certificacion' => $prospectos->document_certificacion,
            'user_id' => $prospectos->user_id,

        ]);

        //  $prospectos->delete();
        return redirect('/prospectos');
        return response()->json(['Guia nuevo' => $guias], 201);
    }

    public function prospectoRegistrado($id)
    {

        $prospecto = ProspectosGuide::where('user_id', $id)->first();
        return response()->json(['Prospecto' => $prospecto], 201);
    }
}
