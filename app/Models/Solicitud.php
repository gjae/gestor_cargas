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
    	'asunto',
    	'user_id',
    	'fecha_solicitada'
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
