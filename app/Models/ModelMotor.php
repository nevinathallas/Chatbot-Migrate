<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelMotor extends Model
{
    protected $guarded = ['id'];

    protected $table = 'model_motor';

    protected $casts = [
        'is_import' => 'boolean',
    ];

    public function variant()
    {
        return $this->hasMany(Variant::class, 'id_model', 'id_model');
    }
}