<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationApprovals extends Model
{
    protected $table = 'reservation_approvals';
    protected $primaryKey = 'approvalID';
    protected $fillable = ['reserveeID', 'east_status', 'cisso_status', 'gso_status', 'final_status'];

    public function reservationDetails()
    {
        return $this->belongsTo(Reservee::class, 'reserveeID', 'reserveeID');
    }

    protected $attributes = [
        'east_status' => 'Pending',
        'cisso_status' => 'Pending',
        'gso_status' => 'Pending',
    ];

}
