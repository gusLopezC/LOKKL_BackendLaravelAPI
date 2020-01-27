<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Payments;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class UpdateTourRealizado extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tour:realizado';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el estado de los registros y los cambia a realizados si paso el dia';

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
        $today = Carbon::today();
        $today->subDays(1);
        $today = Carbon::parse($today)->format('Y-m-d');
        $reservaciones = Payments::all()
            ->where('Fechareserva', '==', $today)
            ->where('status', '==', 'Aceptado');

        foreach ($reservaciones as $reservacion) {
            $reservacion->status = 'Realizado';
            $reservacion->save();
        }

        Log::info('Tarea realizacion de tours y mandado correos de calificacion');
    }
}
