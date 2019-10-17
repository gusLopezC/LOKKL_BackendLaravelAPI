<?php

namespace App\Http\Controllers\Reservas;

use App\Payments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ReservasController extends Controller
{
    //

    public function obtenerMisViajes($id){
        $reservaciones = Payments::with('getGuia')
            ->orderBy('created_at', 'DESC')
            ->where('id_comprador', $id)
            ->get();

        //$reservaciones->getComprador;

        return response()->json(['Reservaciones' => $reservaciones, 200]);
    }

    public function obtenerReservaciones($id)
    {

        $reservaciones = Payments::with('getComprador')
            ->orderBy('created_at', 'DESC')
            ->where('id_guia', $id)
            ->get();

        //$reservaciones->getComprador;

        return response()->json(['Reservaciones' => $reservaciones, 200]);
    }

    public function actualizarEstadoReserva(Request $request)
    {

        $reservacion = Payments::where('id', $request->id)->first();

        if ($request->estado == 'Aceptar') {
            $reservacion->status = $request->estado;
            $reservacion->save();


            $reservaciones = Payments::with('getComprador')
                ->orderBy('created_at', 'DESC')
                ->where('id_guia', $reservacion->id_guia)
                ->get();

            return response()->json(['Reservaciones' => $reservaciones, 200]);
        }
    }
}
