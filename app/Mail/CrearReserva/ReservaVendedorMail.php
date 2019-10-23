<?php

namespace App\Mail\CrearReserva;

use App\Payments;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
class ReservaVendedorMail extends Mailable
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
        $payment->Fechareserva = Carbon::parse($payment->Fechareserva);
        $payment->Fechareserva= $payment->Fechareserva->format('Y-m-d');

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.ReservaVendedorMail')->subject('Haz recibido una reserva');
    }
}
