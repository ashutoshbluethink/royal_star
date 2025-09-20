<?php
 
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
 
 
class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
   
    /**
     * Create a new message instance.
     */
    public $rand_id;
    public function __construct($rand_id)
    {
        $this->rand_id = $rand_id; // Store the random ID
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Forget Password',
        );
    }
 
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.contact',
            with: [
                'rand_id' => $this->rand_id,
               
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