<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRoles extends Model
{
    use HasFactory;
 
    protected $table = 'admin_roles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
    ];
    public function users()
    {
        // One role can have many users
        return $this->hasMany(User::class, 'role_id', 'id');
    }

}
    

