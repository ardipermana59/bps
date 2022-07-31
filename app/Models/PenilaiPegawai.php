<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaiPegawai extends Model
{
    protected $fillable = [
        'employee_id',
        'evaluator_id',
    ];
}
