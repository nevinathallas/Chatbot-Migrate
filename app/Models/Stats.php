<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    protected $guarded = ['id'];
    protected $table = 'stats';

    protected $casts = [
        'is_import' => 'boolean',
    ];

    public function Service()
    {
        return $this->belongsTo(Service::class, 'status_id', 'id_servis');
    }
}
