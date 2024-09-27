<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportPersonnels extends Model
{
    
    protected $table = 'support_personnel';
    protected $primaryKey = 'personnelID';
    protected $fillable = ['pname', 'ptotal_no', 'reservedetailsID'];


    public function reservationDetail()
    {
        return $this->belongsTo(ReservationDetails::class, 'reservedetailsID', 'reservedetailsID');
    }
    
}
