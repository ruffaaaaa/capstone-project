<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endorser extends Model
{

    protected $table = 'endorser';
    protected $primaryKey = 'id';
    protected $fillable = ['reserveeID','name','email', 'confirmation','confirmation_token'];

    public function reservationDetails()
    {
        return $this->belongsTo(Reservee::class, 'reserveeID', 'reserveeID');
    }


}
