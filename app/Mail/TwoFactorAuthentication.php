<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TwoFactorAuthentication extends Mailable
{
    use Queueable, SerializesModels;

    public $twoFactorCode;

    /**
     * Create a new message instance.
     *
     * @param string $twoFactorCode
     */
    public function __construct($twoFactorCode)
    {
        $this->twoFactorCode=$twoFactorCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $subject=$this->twoFactorCode.' - Código de verificacion';
        return $this->from('no-reply@renthub.es', 'RêntHûb.es No-Reply')
                    ->subject($subject)
                    ->view('Mail.onTwoFactorVerification');
    }
}
