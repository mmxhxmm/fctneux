<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
  
    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {   
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Email Reset - ' . $this->user->name)
        ->markdown('email.password-reset')
        ->from(config('mail.from.address'), config('mail.from.name'));
    }
}
