<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Venta extends Model
{
    protected $table = 'detalle_ventas';
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }
    
    
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
