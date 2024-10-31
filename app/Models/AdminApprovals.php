<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminApprovals extends Model
{
    protected $table = 'admin_approvals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'reservation_approval_id',
        'admin_id', 
        'approval_status',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function approval()
    {
        return $this->belongsTo(ReservationApprovals::class, 'reservation_approval_id', 'approvalID');
    }

    
}
