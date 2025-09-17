<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $guarded = ['id'];
    protected $table = 'community';

    protected $casts =[
        'is_active' => 'boolean',
    ];

    public function Motor()
    {
        return $this->belongsToMany(Motor::class, 'community_motor', 'community_id', 'motor_id', 'id', 'id_motorcycle');

    }

}
