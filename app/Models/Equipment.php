<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';
    protected $primaryKey = 'equipmentID';
    protected $fillable = ['reservedetailsID',
                            'ename',
                            'etotal_no'
                            ];

    public function reservationDetail()
    {
        return $this->belongsTo(ReservationDetails::class, 'reservedetailsID', 'reservedetailsID');
    }
}
