<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private $name, public $subject)
    {
        //
    }

    public function envelope()
    {
        return new Envelope(
            from: new Address('ask@mineditse.store', 'Mine Ditse Shop'),
            subject: $this->subject,
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.hello',
            with: ['name' => $this->name]
        );
    }
    
}
