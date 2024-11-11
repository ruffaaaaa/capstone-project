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
    public $status;
    public $eventName;
    public $note;
    public $adminList;
    public $admin; // The admin who updated the status

    /**
     * Create a new message instance.
     *
     * @param  mixed  $reservationApproval
     * @param  string $status
     * @param  string $eventName
     * @param  string|null $note
     * @param  array $adminList
     * @param  Admin $admin
     */
    public function __construct($reservationApproval, $status, $eventName, $note = null, $adminList, $admin)
    {
        $this->reservationApproval = $reservationApproval;
        $this->status = $status;
        $this->adminList = $adminList;
        $this->admin = $admin;  // Store the admin who updated the status
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
                        'status' => $this->status,
                        'adminList' => $this->adminList,
                        'admin' => $this->admin,  // Pass the admin who updated the status to the view
                    ]);
    }
}
