<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    protected $capsule;

    public function __construct($capsule)
    {
        $this->capsule=$capsule;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address("support@dearme.com","Support"),
            subject: 'Capsule Revealed',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        
            $text = "Your Time Capsule Has Been Revealed!\n\n";
            $text .= "Hello {$this->capsule->username},\n\n";
            $text .= "Your capsule '{$this->capsule->title}' is now available.\n\n";
            $text .= "Thanks,\nDear Me Team";

    return new Content(
        text: $text 
    
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
