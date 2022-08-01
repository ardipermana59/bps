<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'position_id',
        'nip',
        'full_name',
        'gender',
        'hp',
        'address',
    ];


    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function position()
    {
        return $this->hasOne('App\Models\Position');
    }

    public function activities()
    {
        return $this->hasMany('App\Models\Activity');
    }

    public function evaluators()
    {
        return $this->hasMany('App\Models\Evaluation', 'evaluator_id');
    }
}
