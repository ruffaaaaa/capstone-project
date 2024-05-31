<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'reservation_attachments';
    protected $primaryKey = 'id';
    protected $fillable = ['reservedetailsID', 'file'];

    public function reservationDetails()
    {
        return $this->belongsTo(ReservationDetails::class, 'reservedetailsID', 'reservedetailsID');
    }

}
