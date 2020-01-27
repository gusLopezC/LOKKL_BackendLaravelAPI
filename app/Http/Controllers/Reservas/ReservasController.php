<?php

namespace App\Http\Controllers\Reservas;


use App\Payments;
use App\Cancelations;
use App\User;

use App\Mail\AceptarTour\AceptarTourCliente;
use App\Mail\AceptarTour\AceptarTourGuia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Mail;


use App\Mail\RechazarTourporGuia\GuiaRechazarTourCliente;
use App\Mail\RechazarTourporGuia\GuiaRechazarTourGuia;


class ReservasController extends Controller
{
    //
    public function index()
    {

        $reservaciones = Payments::orderBy('updated_at', 'DESC')
            ->get();
        // return $reservaciones;
        return view('reservaciones.verreservaciones', compact('reservaciones'));
    }

    public function MostrarDatoSReservacion($id)
    {
        $reservacion = Payments::findOrFail($id);

        $reservacion->getComprador;
        $reservacion->getGuia;
        $reservacion->getTour;

        //return $reservacion;
        return view('reservaciones.detallesreservacion', compact('reservacion'));
    }


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

    public function aceptarTour(Request $request)
    {

        $reservacion = Payments::where('id', $request->id)->first();

        $user = User::where('id', $reservacion->id_comprador)->first();
        $guia = User::where('id', $reservacion->id_guia)->first();

        if ($request->estado == 'Aceptar') {
            $reservacion->status = 'Aceptado';
            $reservacion->save();


            $date = Carbon::now();
            $date = $date->format('Y-m-d');



            $reservaciones = Payments::with('getComprador')
                ->orderBy('created_at', 'DESC')
                ->where('id_guia', $reservacion->id_guia)
                ->where('Fechareserva', '>=', $date)
                ->get();


            $reservacion->getComprador;
            $reservacion->getGuia;
            Mail::to($user->email)->send(new AceptarTourCliente($reservacion));
            Mail::to($guia->email)->send(new AceptarTourGuia($reservacion));


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


    public function obtenertourRealizado()
    {
        $today = Carbon::now();
        $today->subDays(1);
        $today = Carbon::parse($today)->format('Y-m-d h:m:s');

        $reservaciones = Payments::all()
            ->where('status', '==', 'Pendiente')
            ->where('created_at', "<=", $today);

        foreach ($reservaciones as $reservacion) {
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
                'Cancela' => 'Sistema',
                'motivoCancelacion' => 'No respuesta en 24 horas',
                'NumTarjeta' => $reservacion->NumTarjeta,
                'EstadoDinero' => $reservacion->EstadoDinero,
                'id_payments' => $reservacion->id,
                'id_tour' => $reservacion->id_tour,
                'id_comprador' => $reservacion->id_comprador,
                'id_guia'  => $reservacion->id_guia,

            ]);
            $compradores = $reservacion->getComprador;
            $guias = $reservacion->getGuia;
            foreach ($compradores as $comprador) {
                error_log($comprador->email);
                Mail::to($comprador->email)->send(new GuiaRechazarTourCliente($reservacion));
            }
            foreach ($guias as $guia) {
                error_log($guia->email);
                Mail::to($guia->email)->send(new GuiaRechazarTourGuia($reservacion));
            }
        }


        return response()->json(['Reservaciones' => $reservaciones, 200]);
    }
}
