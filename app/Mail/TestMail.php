<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $testMessage;
    public function __construct(string $testMessage)
    {
        $this->testMessage = $testMessage;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Test Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.test',
            with: [
                'testMessage' => $this->testMessage,
            ]
        );
    }
}
