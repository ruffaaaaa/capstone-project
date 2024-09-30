<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationApprovals extends Model
{
    protected $table = 'reservation_approvals';
    protected $primaryKey = 'approvalID';
    protected $fillable = ['reserveeID', 'final_status'];

    public function reservationDetails()
    {
        return $this->belongsTo(Reservee::class, 'reserveeID', 'reserveeID');
    }

    protected $attributes = [
        'final_status' => 'Pending',
    ];

}
