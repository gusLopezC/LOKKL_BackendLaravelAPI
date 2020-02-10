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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MensajesChat $mensaje)
    {

        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('emails.RecibioMensaje.RecibioMensaje')->subject('Haz recibido un mensaje de tu tuor ' . $this->mensaje->getReserva[0]->NameTour );
    }
}
