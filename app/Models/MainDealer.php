<?php

namespace App\Models;

use App\Models\Cabang;
use Illuminate\Database\Eloquent\Model;

class MainDealer extends Model
{
    protected $guarded = ['id'];

    protected $table = 'main_dealer';

    protected $fillable =[
        'id_main',
        'nama_main',
        'alamat',
        'notelp',
        'email'
    ];

    public function Cabang()
    {
        return $this->hasMany(Cabang::class, 'id_main');
    }

    public function Service()
    {
        return $this->hasMany(Service::class, 'id_main', 'id_main');
    }
    
    public function getRouteKeyName()
    {
        return 'id_main';
    }
}
