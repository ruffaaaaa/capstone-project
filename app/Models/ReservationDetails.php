<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationDetails extends Model
{
    protected $table = 'reservation_details';
    protected $primaryKey = 'reservedetailsID';
    protected $fillable = [
        'reservedetailsID',
        'event_name', 
        'event_start_date', 
        'event_end_date', 
        'max_attendees', 
        'preparation_start_date', 
        'preparation_end_date_time', 
        'cleanup_start_date_time',
        'cleanup_end_date_time', 
    ];

    public function facilities()
    {
        return $this->belongsToMany(Facilities::class, 'selected_facilities', 'reservationdetailsID', 'facilityID');
    }

    public function noEquipments()
    {
        return $this->hasOne(NoEquipments::class, 'reservedetailsID', 'reservedetailsID');
    }

    public function reservationAttachments()
    {
        return $this->hasMany(ReservationAttachments::class, 'reservedetailsID', 'reservedetailsID');
    }
    
    public function reservee()
    {
        return $this->belongsTo(Reservee::class, 'reserveeID', 'reserveeID');
    }
}