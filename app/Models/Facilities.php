<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\FacilitiesController;


class Facilities extends Model
{
    protected $table = 'facilities';
    protected $primaryKey = 'facilityID';
    protected $fillable = ['facilityName', 'image', 'facilityStatus'];

    public function reservationDetails()
    {
        return $this->hasMany(ReservationDetails::class, 'facilityID');
    }

    public function selectedFacilities()
    {
        return $this->hasMany(SelectedFacilities::class, 'facilityID', 'facilityID');
    }
    
}
