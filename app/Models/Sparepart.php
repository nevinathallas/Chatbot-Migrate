<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $guarded = ['id'];
    protected $table = 'sparepart';

    public function ModelMotor()
    {
        return $this->belongsTo(ModelMotor::class, 'id_motorcycle', 'id_model');
        
    }
}
