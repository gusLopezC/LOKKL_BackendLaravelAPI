<?php

namespace App\Http\Controllers\Tours;

use App\Guias;
use App\Http\Controllers\Controller;
use App\ToursEspañol;
use Illuminate\Http\Request;

class ToursEspañolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $datosGuia = Guias::where('id', $request->user_guide)->first();

        $tour = ToursEspañol::create([
            'name' => $datosGuia->name,
            'cuidad' => $datosGuia->ciudad,
            'categories' => $request->categories,
            'schedulle' => $request->schedulle,
            'duration' => $request->duration,
            'override' => $request->override,
            'whatsIncluded' => $request->whatsIncluded,
            'itinerary' => $request->itinerary,
            'mapaGoogle' => $request->mapaGoogle,
            'puntoInicio' => $request->puntoInicio,
            'lenguajes' => $datosGuia->idiomas,
            'price' => $request->price,
            'user_guide' => $datosGuia->id,

        ]);

        return response()->json(['Tour' => $tour], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

}
