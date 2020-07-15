<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Sharepostmail extends Mailable
{
    use Queueable, SerializesModels;
    public $linkdata;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($linkdata)
    {
     $this->linkdata = $linkdata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
           return $this->subject('Saved Sites at mysitemanager')
           ->view('email.sharepost');
      
    }
}
