<?php

namespace App\Mail\RechazarTourporGuia;

use App\User;
use App\Payments;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GuiaRechazarTourCliente extends Mailable
{
    use Queueable, SerializesModels;
    public $payment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Payments $payment)
    {

        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.CancelarTour.guiaRechazaTourClienteMail')->subject('Tu reservación a sido cancelada');

    }
}
