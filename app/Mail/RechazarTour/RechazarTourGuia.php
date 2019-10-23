<?php

namespace App\Mail\RechazarTour;

use App\User;
use App\Payments;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RechazarTourGuia extends Mailable
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
        return $this->markdown('emails.CancelarTour.rechazarTourClienteMail')->subject('Tu reserva a sido cancelada');

    }
}
