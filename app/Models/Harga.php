<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    protected $guarded = ['id'];
    protected $table = 'harga';

    protected $cast =[
        'harga' => 'integer'
    ];

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'id_motorcycle', 'id_motorcycle');
    }
}
