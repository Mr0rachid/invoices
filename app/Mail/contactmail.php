<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class contactmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $id;
    public function __construct($invoice_id)
    {
        $this->id = $invoice_id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contactmail',
            from: new Address('contenttik07@gmail.com','nice'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $id = $this->id;
        $url = "http://localhost:8000/invoicesdetails/".$id;
        return new Content(
            view:'test',
            with:compact('url','id'),
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
