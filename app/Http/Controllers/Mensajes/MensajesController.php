<?php

namespace App\Http\Controllers\Mensajes;

use App\User;
use App\MensajesChat;
use App\Payments;

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
        $mensajes = MensajesChat::where('id_comprador', '=', $id)
            //->groupBy('id_reservacion')
            ->get();

        return response()->json(['Mensajes' => $mensajes], 201);
    }


    public function obtenerChatsGuia($id)
    {
        $mensajes = MensajesChat::where('id_guia', '=', $id)
            ->groupBy('id_reservacion')
            ->get();

        return response()->json(['Mensajes' => $mensajes], 201);
    }

    public function obteneSalaMensajesTurista($id)
    {
        $mensajes = MensajesChat::where('id_reservacion', '=', $id)
            //->orderBy('updated_at', 'ASC')
            ->get();

        return response()->json(['Mensajes' => $mensajes], 201);
    }

    public function obteneSalaMensajesGuia($id)
    {

        $mensajes = MensajesChat::where('id_reservacion', '=', $id)
            ->orderBy('updated_at', 'ASC')
            ->get();

        return response()->json(['Mensajes' => $mensajes], 201);
    }

    public function postearMensajeTurista(Request $request)
    {
        try {
            $user = User::where('id', $request->id_user)->first();
            $guia = User::where('id', $request->id_vendedor)->first();
            $reserva = Payments::where('id', $request->id_vendedor)->first();


            $mensajes = MensajesChat::create([
                'mensaje' => $request->stripeToken,
                'escribio' => $request->escribio,
                'id_reservacion' => $request->id_reservacion,
                'id_comprador' => $request->id_comprador,
                'id_guia' => $request->id_guia,
            ]);

            // Mail::to($guia->email)->send(new ReservaClienteMail($mensajes));

            return response()->json(['Mensajes' => $mensajes], 201);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
