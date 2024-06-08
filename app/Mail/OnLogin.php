<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OnLogin extends Mailable
{
    use Queueable, SerializesModels;

    public $userGuest;
    public $ipAddress;
    /**
     * Create a new message instance.
     *
     * @param string $userGuest
     * @param string $ipAddress
     */
    public function __construct($userGuest, $ipAddress)
    {
        $this->userGuest = $userGuest;
        $this->ipAddress = $ipAddress;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@renthub.es', 'RêntHûb.es No-Reply')
                    ->subject('Inicio de sesión')
                    ->view('Mail.onLogin');
    }
}
