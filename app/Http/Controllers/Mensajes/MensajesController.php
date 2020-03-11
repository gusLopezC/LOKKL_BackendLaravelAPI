<?php

namespace App\Http\Controllers\Mensajes;

use App\User;
use App\MensajesChat;
use App\Payments;

use Mail;
use App\Mail\RecibidoMensaje\RecibidoMensaje;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MensajesController extends Controller
{
    //

    public function index()
    {
        return 'Hola';

        $mensajes = MensajesChat::all();
        return response()->json(['Mensajes' => $mensajes], 201);
    }

    public function obtenerChatsTurista($id)
    {
        $mensajes = MensajesChat::with('getGuia')
            ->with('getReserva')
            ->where('id_comprador', '=', $id)
            ->groupBy('id_comprador', 'id_reservacion')
            ->orderBy('mensaje', 'ASC')
            ->get();

        return response()->json(['Mensajes' => $mensajes], 201);
    }


    public function obtenerChatsGuia($id)
    {
        $mensajes = MensajesChat::with('getComprador')
            ->with('getReserva')
            ->where('id_guia', '=', $id)
            ->orwhere('id_comprador', '=', $id)
            ->groupBy('id_comprador', 'id_reservacion')
            ->orderBy('mensaje', 'ASC')
            ->get();


        return response()->json(['Mensajes' => $mensajes], 201);
    }

    public function obtenerChatReservacion($id)
    {
        $mensajes = MensajesChat::where('id_reservacion', '=', $id)
            //->orderBy('updated_at', 'ASC')
            ->get();

        return response()->json(['Mensajes' => $mensajes], 201);
    }

    public function obtenerChatReservacionGuia($id)
    {

        $mensajes = MensajesChat::where('id_reservacion', '=', $id)
            ->orderBy('updated_at', 'ASC')
            ->get();

        return response()->json(['Mensajes' => $mensajes], 201);
    }

    public function sendMessage(Request $request)
    {
        error_log($request);
        $guia = User::where('id', $request->id_guia)->first();

        try {
            $mensajes = MensajesChat::create([
                'mensaje' => $request->mensaje,
                'id_reservacion' => $request->id_reservacion,
                'id_comprador' => $request->id_comprador,
                'id_guia' => $request->id_guia,
            ]);

            $mensajes->getGuia;
            $mensajes->getReserva;

            Mail::to($guia->email)->send(new RecibidoMensaje($mensajes));
            // Mail::to('guslopezcallejas@gmail.com')->send(new RecibidoMensaje($mensajes));


            $mensajes = MensajesChat::where('id_reservacion', '=', $request->id_reservacion)
                //->orderBy('updated_at', 'ASC')
                ->get();
            return response()->json(['Mensajes' => $mensajes], 201);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
