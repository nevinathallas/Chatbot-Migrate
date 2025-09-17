<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Brosur extends Model
{
    protected $guarded = ['id'];
    protected $table = 'brosur';

    public function Motor()
    {
        return $this->belongsTo(Motor::class, 'id_motorcycle', 'id_motorcycle');
    }
}
