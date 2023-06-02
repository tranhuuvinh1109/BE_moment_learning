<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmailUsingGmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $course;
    public $price;
    public $img;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $course
     * @param string $price
     */
    public function __construct($email, $course, $price, $img)
    {
        $this->email = $email;
        $this->course = $course;
        $this->price = $price;
        $this->img = $img;
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
        $this->markdown('mail.send-email-using-gmail')
            ->subject('Successfully Purchased')
            ->with([
                'email' => $this->email,
                'course' => $this->course,
                'price' => $this->price,
                'img' => $this->img,
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
