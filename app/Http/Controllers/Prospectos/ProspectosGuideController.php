<?php

namespace App\Http\Controllers\Prospectos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProspectosGuide;
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
            'email' => 'required|email',
        ];$this->validate($request,$rules);

        $waypoints = implode(",", $request->idiomas);


        $data = $request->all();
        $data['idiomas'] = $waypoints;
        $prospecto = ProspectosGuide::create($data);

         return response()->json(['data'=> $prospecto],201);
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

        return redirect('/prospectos');
    }
}
