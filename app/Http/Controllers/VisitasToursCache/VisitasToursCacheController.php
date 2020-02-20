<?php

namespace App\Http\Controllers\VisitasToursCache;

use App\Tours;
use App\VisitasToursCache;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Mail;
use App\Mail\MailRecordatorio\MailRecodatorio;
use Stripe\ApiOperations\Retrieve;

class VisitasToursCacheController extends Controller
{
    //

    public function guardarVisita(Request $request)
    {

        $registros = VisitasToursCache::where('user_id', '=',  $request->user_id)
            ->get();

        $Existe = false;

        if (count($registros) >= 1) {

            foreach ($registros as $registro) {
                if ($registro->id_tour == $request->id_tour) {
                    $Existe = true;
                    return response()->json(['Mensaje' => 'Ya esta guardado', 200]);
                }
            }
            if (!$Existe) {
                $visitas = VisitasToursCache::create([
                    'id_tour' => $request->id_tour,
                    'user_id' => $request->user_id,
                ]);
                return response()->json(['Mensaje' => 'Creando nuevo', 'Datos' => $visitas, 200]);
            }
        } else {
            $visitas = VisitasToursCache::create([
                'id_tour' => $request->id_tour,
                'user_id' => $request->user_id,
            ]);
            return response()->json(['Mensaje' => 'Primera visita', 200]);
        }
    }

    public function sendCorreosRecordatorio()
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
                'photos_tours.photo'
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

            $visitas->enviado = true;
            $visitas->save();

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

        return 'Ok';
    }
}
