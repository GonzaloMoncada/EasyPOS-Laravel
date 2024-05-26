<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Compra extends Model
{
    protected $table = 'detalle_compras';

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
