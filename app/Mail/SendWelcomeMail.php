<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendWelcomeMail extends Mailable
{
   
    use Queueable, SerializesModels;

    public $email;
    public $password;
    public $url;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $password, $url)
    {
        $this->email = $email;
        $this->password = $password;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to Our Website',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
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


// <!DOCTYPE html>
// <html>
// <head>
//     <title>Welcome to Our Website</title>
// </head>
// <body>
//     <h1>Welcome to Our Website</h1>
//     <p>Dear user,</p>
//     <p>Your account has been successfully created. Here are your login details:</p>
//     <p>Email: {{ $email }}</p>
//     <p>Password: {{ $password }}</p>
//     <p>You can login to your account using the following link:</p>
//     <a href="{{ $url }}">Login Here</a>
//     <p>Thank you for joining us!</p>
// </body>
// </html>
