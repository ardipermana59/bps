<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'description',
        'satuan',
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
