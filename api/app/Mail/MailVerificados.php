<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailVerificados extends Mailable
{
    use Queueable, SerializesModels;

    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): MailVerificados
    {
        return $this
            ->view('layouts.verificadoEmail')
            ->subject('Unidos - Restablecer contraseña')
            ->with([
                "password" => $this->password,
            ]);
    }
}
