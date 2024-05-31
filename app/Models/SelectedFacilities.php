<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedFacilities extends Model
{
    protected $table = 'selected_facilities';
    protected $primaryKey = 'id';

    protected $fillable = [
        'reservedetailsID',
        'facilityID',
    ];

    public function facility()
    {
        return $this->belongsTo(Facilities::class, 'facilityID', 'facilityID');
    }
    
    public function reservationDetail()
    {
        return $this->belongsTo(ReservationDetails::class, 'reservedetailsID', 'reservedetailsID');
    }
}
