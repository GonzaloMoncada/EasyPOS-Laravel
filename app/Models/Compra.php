<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $table = 'compras';

    public function detalle_compra(){
        return $this->hasMany(Detalle_Compra::class, 'id_compra');
    }
}
