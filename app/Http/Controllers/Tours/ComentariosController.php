<?php

namespace App\Http\Controllers\Tours;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Comentarios;
use App\Tours;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timezone = date_default_timezone_get();
        // $date = Carbon\Carbon::now();
        //
        return Carbon::now();;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comentarios = TouComentariosrs::all();

        return response()->json(['Comentarios' => $comentarios, 200]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $date = date('Y-m-d H:i:s');
        $newDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)
            ->format('d-m-Y');

        $rules = [
            'comentario' => 'required',
            'calificacion' => 'required',
        ];

        $this->validate($request, $rules);

        $comentario = Comentarios::create([
            'comentario' => $request->comentario,
            'calificacion' => $request->calificacion,
            'tour_id' => $request->tour_id,
            'user_id' => $request->user_id,
            'created_at' => $newDate
        ]);

        $tour = Tours::find($request->tour_id)->first();;
        $tour->calification = ($tour->calification + $request->calificacion) / 2;
        $tour->save();

        return response()->json(['Comentario' => $comentario], 200);
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
        $comentario = Comentarios::findOrFail($id);

        $comentario->delete();

        return response()->json(['Comentario' => $comentario, 200]);
    }
}
