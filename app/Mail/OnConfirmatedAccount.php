<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OnConfirmatedAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    /**
     * Create a new message instance.
     *
     * @param string $twoFactorCode
     */
    public function __construct($name)
    {
        $this->name=$name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $subject='Bienvenida a RêntHûb.es';
        return $this->from('no-reply@renthub.es', 'RêntHûb.es No-Reply')
                    ->subject($subject)
                    ->view('Mail.onConfirmatedAccount');
    }
}
