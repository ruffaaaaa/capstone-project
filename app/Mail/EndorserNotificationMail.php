<?php

namespace App\Mail;

use Carbon\Carbon; // Import the Carbon library
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EndorserNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $endorsedBy;
    public $reserveeName;
    public $eventStartDate;
    public $eventName;
    public $chosenFacilityList;
    public $confirmationToken; // Add a property for the confirmation token

    public function __construct($endorsedBy, $reserveeName, $eventStartDate, $eventName, $chosenFacilityList, $confirmationToken) // Update the constructor
    {
        $this->endorsedBy = $endorsedBy;
        $this->reserveeName = $reserveeName;
        $this->eventStartDate = Carbon::parse($eventStartDate)->format('F j, Y');
        $this->eventName = $eventName;
        $this->chosenFacilityList = $chosenFacilityList;
        $this->confirmationToken = $confirmationToken; // Assign the token
    }

    public function build()
    {
        return $this->view('emails.endorser_notification')
                    ->subject('Reservation Endorsement Notification')
                    ->with([
                        'endorsedBy' => $this->endorsedBy,
                        'reserveeName' => $this->reserveeName,
                        'eventStartDate' => $this->eventStartDate,
                        'eventName' => $this->eventName,
                        'chosenFacilityList' => $this->chosenFacilityList,
                        'confirmationToken' => $this->confirmationToken, // Pass the token to the view
                    ]);
    }
}
