<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numero_Rifa extends Model
{
    protected $table = 'numero_rifa';
    public $timestamps = false;

    public function rifa(){
        return $this->belongsTo(Rifa::class);
    }
    public function oneNumber($id, $numero){
        return $this->where('id_rifa', $id)->where('numero', $numero);
    }
}
