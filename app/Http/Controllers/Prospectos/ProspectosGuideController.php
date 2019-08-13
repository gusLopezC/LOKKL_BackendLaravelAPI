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

    public function updateDocument(Request $request)
    {
        eror_log($request);
        // $this->validate($request, [
        //     'photo' => 'required|image'
        // ]);
        

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/images/documents', $name);
        }

        // Image::make($file)->fit(144, 144)->save($path);

        $user = auth()->user();
        $user->img = $name;
        $user->save();

        $token = auth()->user()->createToken('dadirugesedevalclkkol')->accessToken;
        return response()->json(['token' => $token, 'user' => $user, 200]);
    }
}
