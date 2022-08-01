<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }

    public function strukturs()
    {
        return $this->hasMany('App\Models\Struktur');
    }
}
