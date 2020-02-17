<?php

namespace App\Console\Commands;


use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;

use App\Tours;
use App\VisitasToursCache;

use Mail;
use App\Mail\MailRecordatorio\MailRecodatorio;

class SendVisitTourUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendVisitTour:User';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mandar correo de recordatorio de comprar';

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

        $ultimosTours = \DB::table('tours')
            ->select(
                'tours.id',
                'tours.name',
                'tours.slug',
                'tours.cuidad',
                'tours.pais',
                'tours.placeID',
                'tours.categories',
                'tours.calification',
                'tours.price',
                'tours.moneda',
                'tours.created_at',
                'photos_tours.photo',
            )
            ->join('photos_tours', 'tours.id', '=', 'photos_tours.tour_id')
            ->take(4)
            ->groupBy('tours.created_at')
            ->orderBy('tours.created_at', 'DESC')
            ->get();


        $ultimosTours = json_encode($ultimosTours);

        $users = VisitasToursCache::select(
            'visitas_tours_caches.user_id',
            'users.name',
            'users.email'
        )
            ->join('users', 'visitas_tours_caches.user_id', '=', 'users.id')
            ->groupBy('visitas_tours_caches.user_id')
            ->get();
        foreach ($users as $user) {

            $visitas = \DB::table('visitas_tours_caches')
                ->select(
                    'visitas_tours_caches.user_id',
                    'visitas_tours_caches.id_tour',
                    'users.name',
                    'users.email',
                    'tours.id',
                    'tours.name',
                    'tours.slug',
                    'tours.cuidad',
                    'tours.pais',
                    'tours.placeID',
                    'tours.categories',
                    'tours.calification',
                    'tours.price',
                    'tours.moneda',
                    'photos_tours.photo',
                )
                ->join('tours', 'visitas_tours_caches.id_tour', '=', 'tours.id')
                ->join('users', 'visitas_tours_caches.user_id', '=', 'users.id')
                ->join('photos_tours', 'tours.id', '=', 'photos_tours.tour_id')
                ->where('visitas_tours_caches.user_id', '=', $user->user_id)
                ->where('visitas_tours_caches.enviado', '=', false)
                ->groupBy('visitas_tours_caches.id_tour')
                ->take(4)
                ->get();

            if ($visitas->count() == 4) {
                $user = json_encode($user);
                $visitas = json_encode($visitas);

                Mail::to('guslopezcallejas@gmail.com')->send(new MailRecodatorio($visitas, $user, $ultimosTours));
            } else {
                $otrosTours = \DB::table('tours')
                    ->select(
                        'tours.id',
                        'tours.name',
                        'tours.slug',
                        'tours.cuidad',
                        'tours.pais',
                        'tours.placeID',
                        'tours.categories',
                        'tours.calification',
                        'tours.price',
                        'tours.moneda',
                        'photos_tours.photo',
                    )
                    ->join('photos_tours', 'tours.id', '=', 'photos_tours.tour_id')
                    ->where('tours.pais', '=', $visitas[0]->pais)
                    ->take(4 - $visitas->count())
                    ->get();

                $user = json_encode($user);
                $visitas = json_encode($visitas);
                $otrosTours = json_encode($otrosTours);

                Mail::to('guslopezcallejas@gmail.com')->send(new MailRecodatorio($visitas, $user, $ultimosTours, $otrosTours));
            } //end else
        } //end foreach

        Log::info('Tarea realizacion de tours y mandado correos de recordatorio');
    }
}
