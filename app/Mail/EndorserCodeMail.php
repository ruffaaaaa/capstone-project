<?php

namespace App\Mail;
use Carbon\Carbon; // Import the Carbon library

use App\Models\Endorser;
use App\Models\Reservee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class EndorserCodeMail extends Mailable
{
    use Queueable, SerializesModels;


    use Queueable, SerializesModels;

    public $name;
    public $reserveeName;
    public $eventStartDate;
    public $nameofevent;
    

    public function __construct($name, $reserveeName, $eventStartDate, $nameofevent, $confirmationToken)
    {
        $this->name = $name;
        $this->reserveeName = $reserveeName;
        $this->eventStartDate = Carbon::parse($eventStartDate)->format('F j, Y');
        $this->nameofevent = $nameofevent;
        $this->confirmationToken = $confirmationToken;

    }

    public function build()
    {
        return $this->subject('Confirmation Needed for Reservation')
                    ->view('emails.endorsement')
                    ->with([
                        'name' => $this->name,
                        'reserveeName'  => $this->reserveeName,
                        'event_start_date'  => $this->eventStartDate,
                        'event_name'  => $this->nameofevent,
                    ]);
    }
}
