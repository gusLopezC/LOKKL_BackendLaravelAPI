<?php

namespace App\Mail\MailRecordatorio;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailRecodatorio extends Mailable
{
    use Queueable, SerializesModels;

    public $otrosTours;
    public $tours;
    public $user;
    public $ultimosTours;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tours, $user,  $ultimosTours, $otrosTours = null)
    {
        $this->tours = json_decode($tours);
        $this->user = json_decode($user);
        $this->otrosTours = json_decode($otrosTours);
        $this->ultimosTours = json_decode($ultimosTours);

        return $this->ultimosTours;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.MailRecordatorio.MailRecordatorio')->subject('Encuentra tu tour ideal');
    }
}
