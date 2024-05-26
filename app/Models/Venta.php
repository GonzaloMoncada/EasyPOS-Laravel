<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'ventas';
    public $timestamps = false;

    public function detalle_venta(){
        return $this->hasMany(Detalle_Venta::class, 'id_venta');
    }
}
