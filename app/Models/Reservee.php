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
        'contact_details',
        'unit_department_company',
        'date_of_filing',
        'endorsed_by',
        'status',
    ];

    
    public function reservationDetails()
    {
        return $this->hasMany(ReservationDetails::class, 'reserveeID', 'reserveeID');
    }
    

    protected $attributes = [
        'status' => 'Pending',
    ];
}
