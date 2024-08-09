<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notificacion_solicitud extends Mailable
{
    use Queueable, SerializesModels;

    public $empresaSolicitante;
    public $name;

    public function __construct($empresaSolicitante, $name)
    {
        $this->empresaSolicitante = $empresaSolicitante;
        $this->name = $name;
    }

    public function build()
    {
        return $this->view('emails.notificacion_convenio')
                    ->with([
                        'empresaSolicitante' => $this->empresaSolicitante,
                        'name' => $this->name
                    ]);
    }
}
