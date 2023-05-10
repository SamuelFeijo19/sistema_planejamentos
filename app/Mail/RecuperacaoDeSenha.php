<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecuperacaoDeSenha extends Mailable
{
    use Queueable, SerializesModels;
    private $usuario;
    private $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\stdClass $usuario, $token)
    {
        //
        $this->usuario = $usuario;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
//        dd($this->usuario->nome, $this->usuario->email);
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
            to: new Address($this->usuario->email, $this->usuario->email),
            subject: 'RBE - Recuperação de senha',
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
            markdown: 'usuario.mail.recuperar-senha',
            with: [
                'usuario' => $this->usuario,
                'token' => $this->token,
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
