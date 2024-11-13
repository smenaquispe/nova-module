<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class AccessHour extends Model
{
    protected $fillable = [
        'start_hour',
        'end_hour',
        'role_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
