<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservationCode;

    public function __construct($reservationCode)
    {
        $this->reservationCode = $reservationCode;
    }

    public function build()
    {
        return $this->subject('Your Reservation Code')
                    ->view('emails.reservation_code')
                    ->with(['reservationCode' => $this->reservationCode]);
    }
}