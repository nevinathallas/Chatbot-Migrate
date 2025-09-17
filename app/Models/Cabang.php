<?php

namespace App\Models;

use App\Models\MainDealer;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $guarded = ['id'];

    protected $table = 'cabang';



    public function MainDealer()
    {
        return $this->belongsTo(MainDealer::class, 'id_main');
    }

}
