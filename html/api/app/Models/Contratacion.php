<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratacion extends Model
{
    use HasFactory;
    protected $table = 'contratacion.contratacion';
    //protected $primaryKey = 'id';
    //public $timestamps = false;

    public function estado(){
        return $this->belongsTo(ContratacionEstado::class,'estado_id','id');
    }

    public function tipo(){
        return $this->belongsTo(ContratacionTipo::class,'tipo_id','id');
    }

    public function modalidad(){
        return $this->belongsTo(ContratacionModalidad::class,'modalidad_id','id');
    }




}

