<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DenialNoteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $note;

    public function __construct($note)
    {
        $this->note = $note;
    }

    public function build()
    {
        return $this->subject('Your Facility Reservation Has Been Denied')
                    ->view('emails.denialNote')
                    ->with(['note' => $this->note]);
    }
}
