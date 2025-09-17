<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $guarded = ['id'];
    protected $table = 'technology';

    public function ModelMotor()
    {
        return $this->belongsTo(ModelMotor::class, 'id_motorcycle', 'id_model');
    }
}
