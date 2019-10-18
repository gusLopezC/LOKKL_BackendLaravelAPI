<?php

namespace App\Http\Controllers\Reservas;

use App\Payments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ReservasController extends Controller
{
    //
    public function obtenerMisViajes($id)
    {

        $date = Carbon::now();
        $date = $date->format('Y-m-d');


        $reservaciones = Payments::with('getGuia')
            ->orderBy('created_at', 'DESC')
            ->where('id_comprador', $id)
            ->where('Fechareserva', '>=', $date)
            ->get();

        //$reservaciones->getComprador;

        return response()->json(['Reservaciones' => $reservaciones, 200]);
    }

    public function obtenerHistorialMisViajes($id)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $reservaciones = Payments::with('getGuia')
            ->orderBy('created_at', 'DESC')
            ->where('id_comprador', $id)
            ->where('Fechareserva', '<', $date)
            ->get();

        //$reservaciones->getComprador;

        return response()->json(['Reservaciones' => $reservaciones, 200]);
    }

    public function obtenerReservaciones($id)
    {

        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $reservaciones = Payments::with('getComprador')
            ->orderBy('created_at', 'DESC')
            ->where('id_guia', $id)
            ->where('Fechareserva', '>=', $date)
            ->get();
        return response()->json(['Reservaciones' => $reservaciones, 200]);
    }

    public function obtenerHistorialReservaciones($id)
    {

        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $reservaciones = Payments::with('getComprador')
            ->orderBy('created_at', 'DESC')
            ->where('id_guia', $id)
            ->where('Fechareserva', '<', $date)
            ->get();
        return response()->json(['Reservaciones' => $reservaciones, 200]);
    }

    public function actualizarEstadoReserva(Request $request)
    {

        $reservacion = Payments::where('id', $request->id)->first();

        if ($request->estado == 'Aceptar') {
            $reservacion->status = 'Aceptado';
            $reservacion->save();


            $reservaciones = Payments::with('getComprador')
                ->orderBy('created_at', 'DESC')
                ->where('id_guia', $reservacion->id_guia)
                ->get();

            return response()->json(['Reservaciones' => $reservaciones, 200]);
        }
    }


    public function obtenerReservacionesCalendario($id)
    {
        $reservaciones = Payments::with('getComprador')
            ->orderBy('created_at', 'DESC')
            ->where('id_guia', $id)
            ->get();

        return response()->json(['Reservaciones' => $reservaciones, 200]);
    }
}
