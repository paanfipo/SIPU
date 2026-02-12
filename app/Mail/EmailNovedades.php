<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailNovedades extends Mailable
{
    use Queueable, SerializesModels;

    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
     public $item;

     public function __construct($notificacion)
    {
        $this->item = $notificacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notificacion '.$this->item["type"])
                ->from('soporte.nortecauca@correounivalle.edu.co', 'Sistema de información de practicas')
                ->view('emprendimiento.emails.notificacion');
    }
}
