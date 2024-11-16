<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Admin;

class ReservationStatusUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservationApproval;
    public $approval_status; // Add this line
    public $eventName;
    public $note;
    public $adminList;
    public $admin; 

    /**
     *
     * @param  mixed 
     * @param  string 
     * @param  string
     * @param  string|null 
     * @param  array 
     * @param  Admin 
     */
    public function __construct($reservationApproval, $approval_status, $eventName, $note = null, $adminList, $admin)
    {
        $this->reservationApproval = $reservationApproval;
        $this->approval_status = $approval_status; // Pass the status here
        $this->eventName = $eventName;
        $this->note = $note;
        $this->adminList = $adminList;
        $this->admin = $admin;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reservation_status_update')
                    ->with([
                        'reservationApproval' => $this->reservationApproval,
                        'approval_status' => $this->approval_status,
                        'eventName' => $this->eventName,
                        'adminList' => $this->adminList,
                        'admin' => $this->admin,  
                    ]);
    }

}
