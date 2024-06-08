<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class onTransactionComplete extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public Transaction $transaction;

    /**
     * Create a new message instance.
     *
     * @param string $twoFactorCode
     */
    public function __construct($name,Transaction $transaction)
    {
        $this->name = $name;
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Factura - Pago completado';
        return $this->from('no-reply@renthub.es', 'RêntHûb.es No-Reply')
            ->subject($subject)
            ->view('Mail.onTransactionComplete');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
