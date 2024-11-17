<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservee extends Model
{
    protected $table = 'reservee';
    protected $keyType = 'string';
    protected $primaryKey = 'reserveeID';

    protected $fillable = [
        'reserveeID',
        'reserveeName',
        'reservedetailsID',
        'person_in_charge_event',
        'email',
        'contact_details',
        'unit_department_company',
        'date_of_filing',
    ];

    
    public function reservationDetails()
    {
        return $this->belongsTo(ReservationDetails::class, 'reservedetailsID', 'reservedetailsID');
    }
    
    public function reservationApproval()
    {
        return $this->hasOne(ReservationApprovals::class, 'reserveeID', 'reserveeID');
    }
}
