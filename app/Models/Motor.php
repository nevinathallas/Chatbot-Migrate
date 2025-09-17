<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    protected $guarded = ['id'];
    protected $table = 'motor';

    public function modelMotor()
    {
        return $this->belongsTo(ModelMotor::class, 'id_motorcycle', 'id_model');

    }

    public function brosur()
    {
        return $this->hasMany(Brosur::class,'id_motorcycle', 'id_motorcycle');
    }

    public function harga()
    {
        return $this->hasOne(Harga::class,'id_motorcycle', 'id_motorcycle');
    }

    public function specs()
    {
        return $this->hasMany(Specs::class,'id_motorcycle', 'id_motorcycle');
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_motor', 'motor_id', 'community_id', 'id_motorcycle', 'id');
    }

    public function promos()
    {
        return $this->belongsToMany(Promo::class,'promo_motor', 'motor_id', 'promo_id', 'id_motorcycle', 'id');
    }

    public function Variant()
    {
        return $this->belongsTo(Variant::class, 'var', 'var');
    }
}
