<?php

namespace App\Http\Controllers\Tours;

use Alert;
use App\PhotosTours;
use App\Tours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotoTourController extends Controller
{
    /**
     * Elimina la imagen que no apruebe el administrador la borramos de AWS y de la bse de datos 
     *  
     */
    public function destroy($photo)
    {

        $Photostour = PhotosTours::where('photo', $photo)->get();


        Storage::disk('s3')->delete('images/tours/' . $photo);
        $Photostour->each->delete();

        //$Photostour->delete();

        return back()->withInput()->withSuccess('Task Created Successfully!');
    }


    /**
     * Elimina la imagen que no apruebe el administrador la borramos de AWS y de la bse de datos 
     *  
     */
    public function destroyPhotoApi($id)
    {

        $Photostour = PhotosTours::where('id', $id)->first();

        Storage::disk('s3')->delete('images/tours/' . $Photostour->photo);
        $Photostour->delete();


        $tour = Tours::with('getPhotos')
            ->where('id', $Photostour->tour_id)->first();

        return response()->json(['Tour' => $tour, 200]);
    }
}
