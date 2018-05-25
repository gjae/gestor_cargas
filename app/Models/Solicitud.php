<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Solicitud extends Model
{
	use SoftDeletes;
    protected $table = 'solicitudes';
    protected $fillable = [
    	'descripcion',
            'descripcion',
            'asunto',
            'fecha_solicitada',
            'telefono',
            'cc',
            'nombre_doctor',
            'apellido_doctor',
            'radio_intraorales',
            'oclusal',
            'extraoral',
            'foto_clinica',
            'otros_servicios',
            'paquete_ortodoncia',
            'user_id',
            'sede_id'
    ];

    protected $casts = [
    	'fecha_solicitada' => 'date',
    ];

    protected $dates = [
    	'deleted_at'
    ];

    public function usuario(){
    	return $this->belongsTo('App\User');
    }

    public function setFechaSolicitadaAttribute($old){
        $this->attributes['fecha_solicitada'] = Carbon::parse($old)->format('Y-m-d');
    }
}
