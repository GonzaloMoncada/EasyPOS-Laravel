<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Rifa extends Model
{
    protected $table = 'rifa';
    public $timestamps = false;

    public function detalle_rifa()
    {
        return $this->hasMany(Detalle_Rifa::class);
    }
    public function numero_rifa()
    {
        return $this->hasMany(Numero_Rifa::class, 'id_rifa');
    }
    public function libres()
    {
        return Numero_Rifa::where('estado', 0)
        ->where('id_rifa', $this->id);
    }
    public function ocupados()
    {
        return Numero_Rifa::where('estado', 1)
        ->where('id_rifa', $this->id);
    }
}
