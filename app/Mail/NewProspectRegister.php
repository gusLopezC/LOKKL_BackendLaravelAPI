<?php

namespace App\Mail;

use App\ProspectosGuide;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewProspectRegister extends Mailable
{
    use Queueable, SerializesModels;

    public $prospectos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ProspectosGuide $prospectos)
    {
        //
        $this->prospectos = $prospectos;

       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newProspecto')->subject('Un nuevo candidato se a registrado');
    }
}
