<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'struktur_id',
        'criteria_id',
        'score',
    ];

    public function strukturs()
    {
        return $this->belongsTo('App\Models\Struktur');
    }
    
    public function criterias()
    {
        return $this->belongsTo('App\Models\Criteria');
    }
}
