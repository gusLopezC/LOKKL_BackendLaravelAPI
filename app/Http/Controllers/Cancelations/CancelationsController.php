<?php

namespace App\Http\Controllers\Cancelations;


use App\Payments;
use App\Cancelations;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Mail;

use App\Mail\RechazarTour\RechazarTourCliente;
use App\Mail\RechazarTour\RechazarTourGuia;
use App\Mail\RechazarTourporGuia\GuiaRechazarTourCliente;
use App\Mail\RechazarTourporGuia\GuiaRechazarTourGuia;


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
        Mail::to($user->email)->send(new RechazarTourCliente($reservacion));
        Mail::to($guia->email)->send(new RechazarTourGuia($reservacion));


        return response()->json(['Reservaciones' => $reservacion, 200]);
    }


    public function cancelarReservacionGuia(Request $request)
    {
        $now = Carbon::now();
        $now = $now->format('Y-m-d');

        $reservacion = Payments::where('order_nr', $request->pedido)
            ->first();

        $user = User::where('id', $reservacion->id_comprador)->first();
        $guia = User::where('id', $reservacion->id_guia)->first();

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


        $reservacion->getComprador;
        $reservacion->getGuia;
        Mail::to($user->email)->send(new GuiaRechazarTourCliente($reservacion));
        Mail::to($guia->email)->send(new GuiaRechazarTourGuia($reservacion));


        return response()->json(['Reservaciones' => $reservacion, 200]);
    }
}
