<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class EnquiryNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Enquiry payload data.
     *
     * @var array
     */
    public array $enquiry;

    /**
     * Create a new message instance.
     */
    public function __construct(array $enquiry)
    {
        $this->enquiry = $enquiry;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = !empty($this->enquiry['subject'])
            ? '[Enquiry] ' . $this->enquiry['subject']
            : '[Enquiry] New Enquiry from ' . ($this->enquiry['name'] ?? 'Website Visitor');

        $envelope = new Envelope(
            subject: $subject,
        );

        if (!empty($this->enquiry['email'])) {
            $senderName = !empty($this->enquiry['name']) ? $this->enquiry['name'] : $this->enquiry['email'];
            $envelope->replyTo = [
                new Address($this->enquiry['email'], $senderName),
            ];
        }

        return $envelope;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.enquiry-notification',
            with: [
                'enquiry' => $this->enquiry,
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
        $attachments = [];

        if (!empty($this->enquiry['attachments']) && is_array($this->enquiry['attachments'])) {
            foreach ($this->enquiry['attachments'] as $storedPath) {
                if (Storage::disk('public')->exists($storedPath)) {
                    $attachments[] = Attachment::fromStorageDisk('public', $storedPath);
                }
            }
        }

        return $attachments;
    }
}
