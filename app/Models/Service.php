<?php

namespace App\Models;

use App\Models\MainDealer;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
   protected $guarded = ['id'];

   protected $table = 'service';

   protected $casts = [
    'masa_berlaku' => 'date',

   ];

   public function MainDealer()
   {
    return $this->belongsTo(MainDealer::class, 'id_main', 'id_main');
   }

   public function Variant()
   {
    return $this->belongsToMany(Variant::class, 'service_variant', 'service_id', 'variant_id', 'id_servis', 'id');
   }

   public function stats()
   {
    return $this->hasMany(Stats::class,'status_id','id_servis');

   }
}
