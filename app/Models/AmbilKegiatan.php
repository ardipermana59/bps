<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmbilKegiatan extends Model
{
    protected $fillable = [
        'employee_id',
        'activity_id',
        'criteria_id',
        'target',
        'nilai',
    ];
}
