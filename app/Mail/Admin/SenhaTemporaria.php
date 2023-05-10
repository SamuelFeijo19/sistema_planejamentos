<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SenhaTemporaria extends Mailable
{
    use Queueable, SerializesModels;
    private $senha;
    private $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $senha)
    {
        //
        $this->email = $email;
        $this->senha = $senha;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
            to: new Address($this->email, $this->email),
            subject: 'RBEvento - CONTA CRIADA',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'admin.participantes.mail.confirma-cadastro',
            with: [
                'email' => $this->email,
                'senha' => $this->senha,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
