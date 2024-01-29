<?php

namespace App\Mail;

use App\Helper\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GenericMail extends Mailable
{
    use Queueable, SerializesModels;

    private ?string $fromMail;
    private ?string $message;
    private ?string $title;

    /**
     * Create a new message instance.
     */
    public function __construct(?string $title, ?string $fromMail, ?string $message)
    {

        $this->fromMail = $fromMail;
        $this->message = $message;
        $this->title = $title;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        return new Envelope(
            from: new Address($this->fromMail ?? ''),
            subject: 'Document Approval Notification: ' . ($this->title ?? ''),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.new-approval',
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
