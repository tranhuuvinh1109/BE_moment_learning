<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMailRegister extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $username;
    public $password;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $course
     * @param string $price
     */
    public function __construct($email, $username, $password)
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Successfully Purchased',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build(): void
    {
        $this->markdown('register.send-mail-register')
            ->subject('Successfully Register Account')
            ->with([
                'email' => $this->email,
                'username' => $this->username,
                'password' => $this->password,
            ]);
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
