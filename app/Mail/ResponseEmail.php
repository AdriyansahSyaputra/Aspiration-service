<?php

namespace App\Mail;

use App\Models\Responses;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResponseEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $response;

    /**
     * Create a new message instance.
     */
    public function __construct(Responses $response)
    {
        $this->response = $response;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tanggapan Aspirasi',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.response',
            with: [
                'id' => $this->response->aspiration->id,
                'userName' => $this->response->user->name,
                'subject' => $this->response->aspiration->title,
                'responseText' => $this->response->response,
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
