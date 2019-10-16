<?php

namespace App\Http\Controllers\Reservas;

use App\Payments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ReservasController extends Controller
{
    //
    public function obtenerReservaciones($id)
    {

        $reservaciones = Payments::with('getComprador')
        ->orderBy('created_at', 'DESC')
            ->where('id_guia', $id)
            ->get();

        //$reservaciones->getComprador;

        return response()->json(['Reservaciones' => $reservaciones, 200]);
    }
}
