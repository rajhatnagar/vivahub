<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $partner;

    /**
     * Create a new message instance.
     */
    public function __construct($client, $partner)
    {
        $this->client = $client;
        $this->partner = $partner;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Wedding Invitation from ' . $this->partner->agency_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.client_invitation',
            with: [
                'groom' => $this->client->groom_name,
                'bride' => $this->client->bride_name,
                'agency' => $this->partner->agency_name,
                'link' => route('register'), // For now pointing to register, could be unique invite link
            ],
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
