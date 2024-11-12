<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $fillable = [
        'name',
        'age',
        'breed',
        'color',
        'weight',
        'size',
        'gender',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
