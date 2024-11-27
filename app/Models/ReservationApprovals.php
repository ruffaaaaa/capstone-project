<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationApprovals extends Model
{
    protected $table = 'reservation_approvals';
    protected $primaryKey = 'approvalID';
    protected $fillable = ['reserveeID', 'final_status'];

    public function reservee()
    {
        return $this->belongsTo(Reservee::class, 'reserveeID', 'reserveeID');
    
    }

    protected $attributes = [
        'final_status' => 'Pending',
    ];

    public function adminRole()
    {
        return $this->belongsTo(AdminRoles::class, 'admin_id', 'id');
    }



}
