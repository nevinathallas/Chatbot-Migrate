<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $guarded = ['id'];
    protected $table = 'promo';

    protected $cast = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    

    public function Motor()
    {
        return $this->belongsToMany(Motor::class,'promo_motor', 'promo_id', 'motor_id', 'id', 'id_motorcycle');
    }
}
