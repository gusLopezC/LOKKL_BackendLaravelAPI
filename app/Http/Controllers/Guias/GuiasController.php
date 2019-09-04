<?php

namespace App\Http\Controllers\Guias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Guias;
class GuiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $guias = Guias::all();

        //return $guias;

        return view('guias.verguias', compact('guias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guias = Guias::findOrFail($id);

        //return $guias;
        return view('guias.detallesguia', compact('guias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guia = Guias::findOrFail($id);
        //return $prospecto;
        $guia->delete();

        $files = array($file1, $file2);
        File::delete($files);

        return redirect('/prospectos');
    }

    public function datosPagos(Request $request){

        $guia = Guias::where('user_id', $request->user_id)->first();

        $guia->pais = $request->pais;
        $guia->tipomoneda = $request->tipomoneda;
        $guia->clabeInterbancaria = $request->clabeInterbancaria;
        $guia->numeroCuenta = $request->numeroCuenta;
        $guia->RFC = $request->RFC;
        $guia->CURP = $request->CURP;

        $guia->save();
        error_log($request);
        return response()->json(['guia' => $guia], 201);

    }
}
