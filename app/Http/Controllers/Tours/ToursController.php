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
       
        //$waypoints = implode(",", $request->idiomas);
       // error_log($waypoints);

        //

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
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
                error_log($name);
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



    public function ObtenerTour($slug)
    {
        $tour = Tours::with('getPhotos')
            ->where('slug', $slug)->first();

        $guia = DB::table('users')->select('id', 'name', 'infopersonal', 'img')
            ->where('id', '=', $tour->user_id)
            ->get();

        $comentarios = Comentarios::with('getUser:id,name')
            ->where('tour_id', '=', $tour->id)->get();



        return response()->json(['Tour' => $tour, "Guia" => $guia, "Comentarios" => $comentarios, 200]);
    }

    /**
     * Obtener por cuidad
     */
    public function ObtenerMisTours($id)
    {
        $tour = Tours::with('getPhotos')
            ->where('user_id', $id)
            ->get();

        // error_log($tour->getPhotos);

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
}
