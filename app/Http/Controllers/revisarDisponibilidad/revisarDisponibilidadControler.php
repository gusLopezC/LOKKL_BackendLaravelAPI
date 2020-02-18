<?php

namespace App\Http\Controllers\revisarDisponibilidad;


use App\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class revisarDisponibilidadControler extends Controller
{
    //


    public function revisarDisponibilidad($id)
    {
        $fechas = Payments::
        select('Fechareserva')
        ->where('id_tour','=', $id)
        ->get();

        return response()->json(['Fechas' => $fechas, 200]);
    }
}
