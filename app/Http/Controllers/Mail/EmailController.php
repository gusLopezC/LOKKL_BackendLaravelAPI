<?php

namespace App\Http\Controllers\Mail;

use App\Mail\SendMailable;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function index()
    {
        return "Hola mundo";
    }
    public function EmailContact(Request $request)
    {
        
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'textomensaje' => 'required'
        ];
       
        $this->validate($request, $rules);


        $objMensaje = new \stdClass();
        $objMensaje->name = $request->name;
        $objMensaje->email = $request->email;
        $objMensaje->textomensaje = $request->textomensaje;

       
         Mail::to('iam@lokkl.com')->send(new SendMailable($objMensaje));

         if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        }else{
            return response()->json(['mensaje' => 'Your Email send', 200]);
          }
    }
}
