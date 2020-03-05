<?php

namespace App\Http\Controllers\Tours;

use Alert;
use App\Comentarios;
use App\Http\Controllers\Controller;
use App\Tours;
use App\PhotosTours;
use App\TourExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;

use Google\Cloud\Translate\V2\TranslateClient;

class ToursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tours = Tours::all();

        // foreach ($tour->getPhotos as $photos) {
        //     $photostour = ($photos->photo);
        // }

        return view('tours.vertours', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $slug = SlugService::createSlug(Tours::class, 'slug', $request->name, ['unique' => false]);

        $tour = Tours::create([
            'cuidad' => $request->cuidad,
            'pais' => $request->Pais,
            'placeID' => $request->placeID,

            'name' => $request->name,
            'slug' => $request->$slug,

            'mapaGoogle' => $request->mapaGoogle,
            'puntoInicio' => $request->puntoInicio,

            'schedulle' => $request->schedulle,

            'itinerary' => $request->itinerary,
            'whatsIncluded' => $request->whatsIncluded,

            'categories' => $request->categories,
            'duration' => $request->duration,
            'lenguajes' => $request->idiomas,
            'price' => $request->price,
            'priceFinal' => $request->price + ($request->price * .20),
            'moneda' => $request->moneda,

            'user_id' => $request->user_id,

        ]);



        return response()->json(['Tour' => $tour], 200);

            // }

        ;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour = Tours::find($id);

        foreach ($tour->getPhotos as $photos) {
            $potos = ($photos->photo);
        }

        return response()->json(['tours' => $tour, 200]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function EditarTours(Request $request)
    {

        $tour = Tours::where('id', $request->id)->first();
        $tour->cuidad  = $request->cuidad;
        $tour->pais  = $request->pais;
        $tour->placeID  = $request->placeID;

        $tour->name  = $request->name;

        $tour->mapaGoogle  = $request->mapaGoogle;
        $tour->puntoInicio  = $request->puntoInicio;

        $tour->schedulle  = $request->schedulle;

        $tour->categories  = $request->categories;
        $tour->duration  = $request->duration;
        $tour->lenguajes  = $request->lenguajes;

        $tour->price  = $request->price;
        $tour->priceFinal  = $request->price + ($request->price * .20);
        $tour->moneda = $request->moneda;
        $tour->save();
        return response()->json(['Tour' => $tour], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
        try {
            $tour = Tours::findOrFail($id);

            $Photostour = PhotosTours::where('tour_id', $tour->id)->get();

            foreach ($Photostour as $photos) {

                Storage::disk('s3')->delete('images/tours/' . $photos->photo);
                $Photostour->each->delete();
            }

            $tour->delete();

            return response()->json(['Tour' => $Photostour, 200]);
        } catch (PDOException $e) {
            return response()->json('existe un error' + $e);
        }
    }


    public function uploadFiles(Request $request, $id)
    {
        $tour = Tours::where('id', $id)->first();

        $files = $request->file('file');


        if ($request->hasFile('file')) {

            foreach ($files as $file) {
                $name =  $id . '_' . time() . $file->getClientOriginalName();

                $filePath = '/images/tours/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($file));


                $phototour = PhotosTours::create([
                    'photo' => $name,
                    'tour_id' => $id,
                ]);
            }
            return response()->json(['tours' => $tour, 200]);
        }
    }


    /**
     * Obtener por cuidad
     */
    public function ObtenerPorCiudad($placeID)
    {

        $tour = Tours::with('getPhotos')
            ->where('placeID', $placeID)
            ->where('verificado', 'Si')
            ->get();

        //$tour->price =  $tour->price + ($tour->price * .20);

        // $tourextra = TourExtra::where('ciudad', $ciudad)->first();
        $tourextra = TourExtra::where('ciudad', 'default')->first();
        if (!$tourextra) {

            $tourextra = TourExtra::where('ciudad', 'default')->first();

            return response()->json(['Tour' => $tour, 'TourExtra' => $tourextra, 200]);
        }


        return response()->json(['Tour' => $tour, 'TourExtra' => $tourextra, 200]);
    }



    public function ObtenerTour($slug, $lenguaje)
    {
        /**
         * Obtener tour y su traduccion
         */
        $tour = Tours::with('getPhotos')
            ->where('slug', $slug)->first();

        if ($tour->lenguaje == $lenguaje) {
            $guia = DB::table('users')->select('id', 'name', 'infopersonal', 'img')
                ->where('id', '=', $tour->user_id)
                ->get();

            $comentarios = Comentarios::with('getUser:id,name')
                ->where('tour_id', '=', $tour->id)->get();

            return response()->json(['Tour' => $tour, "Guia" => $guia, "Comentarios" => $comentarios, 200]);
        } else {
            $translate = new TranslateClient([
                'key' => 'AIzaSyDCzUElgJv_LpGRv6XXhUNyoBv-HD4ABPo'
            ]);

            $content = [
                'name' => $tour->name,
                'cuidad' => $tour->cuidad,
                'schedulle' => $tour->schedulle,
                'puntoInicio' => $tour->puntoInicio,
                'whatsIncluded' => $tour->whatsIncluded,
                'itinerary' => $tour->itinerary,
            ];
            // Translate text .

            foreach ($content as $key => $text) {
                $result = $translate->translate($text, [
                    'target' => $lenguaje
                ]);
                $tour->{$key} = $result['text'];
            }

            $tour->whatsIncluded = str_replace("&quot;", "\"", $tour->whatsIncluded);
            $tour->itinerary = str_replace("&quot;", "\"", $tour->itinerary);


            $guia = DB::table('users')->select('id', 'name', 'infopersonal', 'img')
                ->where('id', '=', $tour->user_id)
                ->get();

            $comentarios = Comentarios::with('getUser:id,name')
                ->where('tour_id', '=', $tour->id)->get();

            return response()->json(['Tour' => $tour, "Guia" => $guia, "Comentarios" => $comentarios, 200]);
        }
    }

    /**
     * Obtener por cuidad
     */
    public function ObtenerMisTours($id)
    {
        $tour = Tours::with('getPhotos')
            ->where('user_id', $id)
            ->get();


        return response()->json(['Tours' => $tour, 200]);
    }




    /**
     * 
     * 
     * Metodos para la administracion aceptar tour y verificar toda la info de los tours
     */


    public function MostrarDatoTour($id)
    {


        $tours = Tours::find($id);

        $arrayCordenanaMapa = preg_split("/[,]/", $tours->mapaGoogle);
        $tours->mapaGoogle = $arrayCordenanaMapa;

        foreach ($tours->getPhotos as $photos) {
            $potos = ($photos->photo);
        }

        $tours->getUser;

        //return $tours;
        return view('tours.detallestour', compact('tours'));
    }

    public function AceptarTour($tour)
    {


        $datatour = Tours::findOrFail($tour);

        $datatour->verificado = "Si";
        $datatour->save();

        //Alert::success('Tour aprobado');
        return redirect('/tours');
    }

    public function NegarTour($id)
    {
        try {
            $tour = Tours::findOrFail($id);

            $Photostour = PhotosTours::where('tour_id', $id)->get();

            foreach ($Photostour as $photos) {

                Storage::disk('s3')->delete('images/tours/' . $photos->photo);
                $Photostour->each->delete();
            }

            $tour->delete();

            return redirect('/tours');
        } catch (PDOException $e) {
            return "A ocurrido un error" + $e;
        }
    }

    public function nameIngles()
    {
        $tours = Tours::all();

        $translate = new TranslateClient([
            'key' => 'AIzaSyDCzUElgJv_LpGRv6XXhUNyoBv-HD4ABPo'
        ]);


        foreach ($tours as $tour) {

            $result = $translate->translate($tour->name, [
                'target' => 'en'
            ]);

            $tour->nameIngles = $result['text'];
            $tour->save();
        }
        $tour->save();
    }
}
