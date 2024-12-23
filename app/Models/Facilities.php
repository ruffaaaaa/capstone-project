<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\FacilitiesController;


class Facilities extends Model
{
    protected $table = 'facilities';
    protected $primaryKey = 'facilityID';
    protected $fillable = ['facilityName', 'image', 'facilityStatus','active'];

    public function reservationDetails()
    {
        return $this->belongsToMany(ReservationDetails::class, 'selected_facilities', 'facilityID', 'reservedetailsID');
    }

}
