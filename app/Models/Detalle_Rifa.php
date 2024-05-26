<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Rifa extends Model
{
    protected $table = 'detalle_rifa';
    public $timestamps = false;

    public function rifa()
    {
        return $this->belongsTo(Rifa::class);
    }
}
