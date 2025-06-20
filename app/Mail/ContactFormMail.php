<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $subject;
    public $message_content;
    
    /**
     * Create a new message instance.
     */
     public function __construct($name, $email, $subject, $message_content)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->message_content = $message_content;
    }

    /**
     * Get the message envelope.
     */
     public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject, // The subject for the email received by grocksilem@gmail.com
            replyTo: [
                new \Illuminate\Mail\Mailables\Address($this->email, $this->name),
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form', // This refers to resources/views/emails/contact-form.blade.php
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->subject,
                'message_content' => $this->message_content,
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
