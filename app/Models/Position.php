<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'name',
    ];

    public function employee()
    {
        return $this->hasOne('App\Models\Employee');
    }
}
