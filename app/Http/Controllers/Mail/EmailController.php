<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\ProspectoMailDocuments;
use App\Mail\SendMailable;
use App\ProspectosGuide;
use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{

    public function EmailContact(Request $request)
    {

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'textomensaje' => 'required',
        ];

        $this->validate($request, $rules);

        $objMensaje = new \stdClass();
        $objMensaje->name = $request->name;
        $objMensaje->email = $request->email;
        $objMensaje->textomensaje = $request->textomensaje;

        Mail::to('iam@lokkl.com')->send(new SendMailable($objMensaje));

        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        } else {
            return response()->json(['mensaje' => 'Your Email send', 200]);
        }
    }
    public function SolicitarDocumentacionProspectos($prospectos)
    {
        $prospectos = ProspectosGuide::findOrFail($prospectos);
        $prospectos->estado = 'Pendiente';
        $prospectos->save();

        Mail::to($prospectos->emailContacto)->send(new ProspectoMailDocuments($prospectos));

        return 'Email enviado';

    }
}
