<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedbackNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $feedback;

    public function __construct($feedback)
    {
        $this->feedback = $feedback;
    }

    public function build()
    {
        return $this->subject('Có phản hồi mới từ website')
            ->view('emails.feedback_notification');
    }
}
