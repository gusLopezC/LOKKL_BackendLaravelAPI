<?php

namespace App\Http\Controllers\Cancelations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payments;
use App\Cancelations;

use Carbon\Carbon;


class CancelationsController extends Controller
{
    //
    //
    public function index()
    {

        $cancelaciones = Cancelations::orderBy('updated_at', 'DESC')
            ->get();
        // return $reservaciones;
        return view('reservaciones.cancelaciones.vercancelaciones', compact('cancelaciones'));
    }

    public function MostrarCancelacion($id)
    {
        $cancelacion = Cancelations::findOrFail($id);

        $cancelacion->getComprador;
        $cancelacion->getGuia;
        $cancelacion->getTour;

        return view('reservaciones.cancelaciones.detallescancelacion', compact('cancelacion'));
    }


    public function obtenerDiferenciasDias($orden)
    {

        $reservacion = Payments::where('order_nr', $orden)
            ->first();
        $now = Carbon::now();
        //$now = $now->format('Y-m-d');
        $date = Carbon::parse($reservacion->Fechareserva);
        $date->addHours(12); 
        //$date = $date->format('Y-m-d');
        $diff = $date->diffInHours($now);

        return response()->json(['Reservaciones' => $reservacion, 'HorasparaTour' => $diff, 200]);
    }


    public function cancelarReservacionCliente(Request $request)
    {

        $now = Carbon::now();
        $now = $now->format('Y-m-d');

        $reservacion = Payments::where('order_nr', $request->pedido)
            ->first();

        $reservacion->status = 'Cancelado';
        $reservacion->save();

        $Cancelación = Cancelations::create([
            'order_nr' => $reservacion->order_nr,
            'ModoPago' => $reservacion->ModoPago,
            'Monto' => $reservacion->Monto,
            'Moneda' => $reservacion->Moneda,
            'Fechareserva' => $reservacion->Fechareserva,
            'FechaCancelacion' =>   $reservacion->Fechareserva,
            'Estado' => $reservacion->status,
            'Cancela' => 'Cliente',
            'motivoCancelacion' => $request->motivo,
            'NumTarjeta' => $reservacion->NumTarjeta,
            'EstadoDinero' => $reservacion->EstadoDinero,
            'id_payments' => $reservacion->id,
            'id_tour' => $reservacion->id_tour,
            'id_comprador' => $reservacion->id_comprador,
            'id_guia'  => $reservacion->id_guia,

        ]);

        return response()->json(['Reservaciones' => $reservacion, 200]);
    }


    public function cancelarReservacionGuia(Request $request)
    {
        $now = Carbon::now();
        $now = $now->format('Y-m-d');

        $reservacion = Payments::where('order_nr', $request->pedido)
            ->first();

        $reservacion->status = 'Cancelado';
        $reservacion->save();

        $Cancelación = Cancelations::create([
            'order_nr' => $reservacion->order_nr,
            'ModoPago' => $reservacion->ModoPago,
            'Monto' => $reservacion->Monto,
            'Moneda' => $reservacion->Moneda,
            'Fechareserva' => $reservacion->Fechareserva,
            'FechaCancelacion' =>   $reservacion->Fechareserva,
            'Estado' => $reservacion->status,
            'Cancela' => 'Guia',
            'motivoCancelacion' => $request->motivo,
            'NumTarjeta' => $reservacion->NumTarjeta,
            'EstadoDinero' => $reservacion->EstadoDinero,
            'id_payments' => $reservacion->id,
            'id_tour' => $reservacion->id_tour,
            'id_comprador' => $reservacion->id_comprador,
            'id_guia'  => $reservacion->id_guia,

        ]);

        return response()->json(['Reservaciones' => $reservacion, 200]);
    }
}
