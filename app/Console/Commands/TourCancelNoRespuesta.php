<?php

namespace App\Console\Commands;

use App\Payments;
use App\Cancelations;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;

use Carbon\Carbon;
use Mail;

use App\Mail\RechazarTourporGuia\GuiaRechazarTourCliente;
use App\Mail\RechazarTourporGuia\GuiaRechazarTourGuia;

class TourCancelNoRespuesta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tour:noRespuesta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tour cancelado por que guia no contesto';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
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
                Mail::to($comprador->email)->send(new GuiaRechazarTourCliente($reservacion));
            }
            foreach ($guias as $guia) {
                Mail::to($guia->email)->send(new GuiaRechazarTourGuia($reservacion));
            }
        }
        Log::info('Tarea realizacion de tours y mandado correos de calificacion');

    }//end metodo
}
