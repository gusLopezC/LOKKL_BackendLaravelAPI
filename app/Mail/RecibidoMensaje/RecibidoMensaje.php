<?php

namespace App\Mail\RecibidoMensaje;

use App\MensajesChat;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecibidoMensaje extends Mailable
{
    use Queueable, SerializesModels;
    public $mensaje;
    public $receptor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MensajesChat $mensaje, $receptor)
    {
        $this->mensaje = $mensaje;
        $this->receptor = $receptor;
        $this->transformImagen($receptor->img);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.RecibioMensaje.RecibioMensaje')->subject('Haz recibido un mensaje de tu tuor ' . $this->mensaje->getReserva[0]->NameTour);
    }


    public function transformImagen($imagen)
    {

        $pos = strrpos($imagen, "https");
        if ($pos === false) { // nota: tres signos de igual
            $this->receptor->img = 'https://lokkl.s3.us-east-2.amazonaws.com/images/profile/' . $imagen;
            error_log('No encontrado');
        } else {
            $this->receptor->img = $imagen;
            error_log('Si encontrado');
        }
    }
}
