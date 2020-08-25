<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Sharenotemail extends Mailable
{
    use Queueable, SerializesModels;
    public $notedata;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notedata)
    {
     $this->notedata = $notedata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
           return $this->subject('Saved Notes at MySiteManager')
           ->view('email.sharenotes');

    }
}
