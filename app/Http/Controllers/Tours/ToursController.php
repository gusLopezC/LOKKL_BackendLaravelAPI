<?php

namespace App\Http\Controllers\Tours;

use App\Guias;
use App\Http\Controllers\Controller;
use App\Tours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;
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
        $tour = ToursEspañol::all();

        // foreach ($tour->getPhotos as $photos) {
        //     $photostour = ($photos->photo);
        // }

        return response()->json(['tours' => $tour, 200]);
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

       // if ($request->hasFile('photo')) {
            $datosGuia = Guias::where('user_id', $request->user_id)->first();
            $slug = SlugService::createSlug(Tours::class, 'slug', $request->name, ['unique' => false]);

            $tour = Tours::create([
                'cuidad' => $request->cuidad,
                'pais' => $request->Pais,
                'CP' => '',

                'name' => $request->name,
                'slug' => $slug,

                'mapaGoogle' => $request->mapaGoogle,
                'puntoInicio' => $request->puntoInicio,

                'schedulle' => $request->schedulle,
                'overview' => $request->overview,

                'itinerary' => '',
                'whatsIncluded' => '',

                'categories' => $request->categories,
                'duration' => $request->duration,
                'lenguajes' => $datosGuia->idiomas,
                'price' => $request->price,
                'user_guide' => $datosGuia->id,
                'user_id' => $request->user_id,

            ]);

            $files = $request->file('photo');

            foreach ($files as $file) {
                $name = time() . $file->getClientOriginalName();
                $filePath = '/images/tours/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($file));

                $phototour = PhotosTours::create([
                    'photo' => $name,
                    'tour_id' => $tour->id,
                ]);
            }

            return response()->json(['Tour' => $tour], 200);

        //}

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour = ToursEspañol::find($id);

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
            $tour = ToursEspañol::findOrFail($id);
            foreach ($tour->photos as $photos) {
                Storage::disk('s3')->delete('images/tours/' . $photos->photo);
            }
            $tour->delete();

            return response()->json(['data' => $tour, 200]);
        } catch (PDOException $e) {
            return response()->json('existe un error'+$e);
        }
    }

    /**
     * Obtener por cuidad
     */
    public function Obtenerporcuidad(Request $request)
    {

        $tour = ToursEspañol::where('cuidad', $request->cuidad)->get();
        // foreach ($tour->photos as $photos) {
        //      $potos = ($photos->photo);
        // }
        return response()->json(['data' => $tour, 200]);

    }

}
