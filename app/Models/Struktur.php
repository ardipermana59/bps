<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    protected $fillable = [
        'employee_id', 'evaluator_id', 'activity_id',
    ];
}
