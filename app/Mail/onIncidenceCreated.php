<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Contract\Contract;
use App\Models\Contract\ContractIncident;
use Illuminate\Support\Facades\Auth;

class onIncidenceCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $incidence;

    /**
     * Create a new message instance.
     *
     * @param string $twoFactorCode
     */
    public function __construct($incidence)
    {
        $this->incidence=$incidence;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $contract_display_id = Contract::where('id', $this->incidence->contract_id)->value('display_id');
        $incidenceType = ContractIncident::getTypeText($this->incidence->type);
        $userData = User::getTypedData(Auth::user()->type, Auth::user()->id);
        $userFullName = $userData->name . ' ' . $userData->surname;
        $subject = $this->incidence->display_id . ' - Incidencia creada';
        
        return $this->from('no-reply@renthub.es', 'RentHub.es No-Reply')
                    ->subject($subject)
                    ->view('Mail.onIncidenceCreated')
                    ->with([
                        'contract_id' => $contract_display_id,
                        'incidence' => $this->incidence,
                        'incidenceType' => $incidenceType,
                        'userFullName' => $userFullName
                    ]);
    }
    
}
