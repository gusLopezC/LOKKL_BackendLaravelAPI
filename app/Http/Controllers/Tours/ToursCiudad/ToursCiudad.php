<?php

namespace App\Http\Controllers\Tours\ToursCiudad;

use App\Tours;
use App\PhotosTours;
use App\TourExtra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ToursIngles;

class ToursCiudad extends Controller
{
    //
    public function ObtenerToursNuevos()
    {
        $tour = Tours::with('getPhotos')
            ->where('verificado', 'Si')
            ->orderBy('created_at', 'DESC')
            ->take(4)
            ->get();

        return response()->json(['Tour' => $tour,  200]);
    }

    public function ObtenerToursCiudad($ciudad)
    {
        $tour = Tours::with('getPhotos')
            ->where('verificado', 'Si')
            ->orderBy('created_at', 'DESC')
            ->where('pais', $ciudad)
            ->take(4)
            ->get();

        return response()->json(['Tour' => $tour,  200]);
    }

    public function ObtenerTourInfiniteScroll($lenguage)
    {

        if ($lenguage == 'es') {
            $tour = Tours::select('id', 'name', 'slug', 'price', 'duration', 'calification', 'categories')
                ->with('getPhotos')
                ->where('verificado', 'Si')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        } else {
            $tour = ToursIngles::select('id', 'name', 'slug', 'price', 'duration', 'calification', 'categories')
                ->with('getPhotos')
                ->where('verificado', 'Si')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }

        return response()->json(['Tour' => $tour,  200]);
    }
}
