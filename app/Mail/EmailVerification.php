<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Config;
use URL;
use Carbon\Carbon;
class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $id;
    public $email;
    public $hash;
    public $verifyUrl;

    public function __construct($user_id,$user_email)
    {
        $this->id = $user_id;
        $this->email = $user_email;
        $this->hash = sha1($user_email);

        $this->verifyUrl = URL::temporarySignedRoute('verification.verify',
            \Illuminate\Support\Carbon::now()->addMinutes(\Illuminate\Support\Facades 
            \Config::get('auth.verification.expire', 60)),
            [
                'id' => $this->id,
                'hash' => sha1($this->email),
            ]
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Verificar correo electronico')
                    ->from('soporte.nortecauca@correounivalle.edu.co', 'Sistema de información de practicas')
                    ->view('emprendimiento.emails.emailVerification');
    }
}
