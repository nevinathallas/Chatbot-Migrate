<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specs extends Model
{
   protected $guarded = ['id'];
    protected $table = 'specs';

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'id_motorcycle', 'id_motorcycle');
    }
}
