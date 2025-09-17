<?php

namespace App\Models;

use App\Models\ModelMotor;
use App\Models\Service;
use App\Models\Stats;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{

    
    protected $guarded = ['id'];
    protected $table = 'variant';
    
    public function ModelMotor()
    {
        return $this->belongsTo(ModelMotor::class, 'id_model', 'id_model');
    }

    public function Service()
    {
        return $this->belongsTo(Service::class,'status_id', 'id_servis');
    
    }

    public function Motor()
    {
        return $this->hasMany(Motor::class, 'var', 'var');
    }

}
