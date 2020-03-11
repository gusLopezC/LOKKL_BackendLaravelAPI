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
        $fechas = Payments::select(
            'payments.Fechareserva',
            'payments.hora',
            'tours.duration'
        )
            ->join('tours', 'payments.id_tour', '=', 'tours.id')
            ->where('id_tour', '=', $id)
            ->get();

        foreach ($fechas as $fecha) {

            $fecha = new \DateTime($fecha->Fechareserva . $fecha->hora);
            
            $fecha->modify("+1");

            return response()->json(['Fechas' => $fecha]);
           
        }

        return response()->json(['Fechas' => $fechas, 200]);
    }
}
