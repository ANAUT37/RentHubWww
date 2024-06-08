<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\Anuncio;
use App\Models\Messages\ChatRequest;
use App\Models\Messages\Chat;
use App\Models\User;
use App\Models\Particular;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class OnChatRequestAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $chatRequest;

    /**
     * Create a new message instance.
     *
     * @param string $twoFactorCode
     */
    public function __construct($chatRequest)
    {
        $this->chatRequest=$chatRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   

        $subject = 'Solicitud de chat aceptada';
        
        $receiverUserData=User::getDataById($this->chatRequest->sender_id);
        $receiverData=User::getTypedData($receiverUserData->type,$receiverUserData->id);

        $ownerUserData=User::getDataById($this->chatRequest->receiver_id);
        $ownerTypedData=User::getTypedData($ownerUserData->type,$ownerUserData->id);

        $anuncioData=Anuncio::getById($this->chatRequest->anuncio_id);
        
        return $this->from('no-reply@renthub.es', 'RentHub.es No-Reply')
                    ->subject($subject)
                    ->view('Mail.onChatRequestAccepted')
                    ->with([
                        'ownerName' => $ownerTypedData->name,
                        'name' => $receiverData->name,
                        'display_id' => $anuncioData->display_id
                    ]);
    }
}
