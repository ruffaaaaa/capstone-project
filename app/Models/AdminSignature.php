<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSignature extends Model
{
    use HasFactory;

    protected $table = 'admin_signature';
    protected $primaryKey = 'id';
    protected $fillable = [
        'admin_id',
        'signature_file',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
