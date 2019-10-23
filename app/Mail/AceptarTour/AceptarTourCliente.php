<?php

namespace App\Mail\AceptarTour;

use App\User;
use App\Payments;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AceptarTourCliente extends Mailable
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
        return $this->markdown('emails.TourAceptado.tourAceptadoClienteMail')->subject('Tu reserva a sido aceptada');

    }
}
