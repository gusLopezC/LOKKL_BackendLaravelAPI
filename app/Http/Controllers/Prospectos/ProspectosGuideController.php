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
        return view('prospectos', compact('prospectos'));
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ];$this->validate($request,$rules);

        $data = $request->all();

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
        return response()->json(['data'=> $prospecto],201);

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
