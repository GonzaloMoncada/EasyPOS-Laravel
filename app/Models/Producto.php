<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false;

    public function detalle_compras()
    {
        return $this->hasMany(Detalle_Compra::class, 'id_producto');
    }

    public function detalle_ventas()
    {
        return $this->hasMany(Detalle_Venta::class, 'id_producto');
    }
    public function detalle_rifa()
    {
        return $this->hasMany(Detalle_Rifa::class, 'id_producto');
    }
}