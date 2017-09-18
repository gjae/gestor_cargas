<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ficha extends Model
{
    protected $table = 'fichas';

    protected $fillable = [
            'servicio', 
            'ubicacion_id',
            'marca', 
            'modelo', 
            'serie', 
            'representante', 
            'ciudad_representante',
            'telefono_representante', 
            'anio_fabricacion',
            'fecha_compra',
            'fecha_instalacion',
            'fecha_inicio_operaciones',
            'material_id',
            'tipo_adquisicion',
            'tipo_mantenimiento',
            'fuente_energia',
            'tipo_uso', 
            'equipo', 
            'mantenimiento',
            'calif_biomedica',
            'tecn_predeterminada', 
            'tipo_riesgo',
            'voltaje',
            'amperaje',
            'potencia',
            'frecuencia',
            'capacidad',  
            'presion',
            'vel',
            'temperatura',
            'peso',
            'vida_util',
            'frecuencia_mantenimiento',
            'manuales', 
            'distribuidor_id',
            'fabricante_id'
    ];

    protected $casts = [
    	'fecha_instalacion' => 'date',
    	'fecha_compra' => 'date',
    	'fecha_inicio_operaciones' => 'date',

    ];


    public function material(){
    	return $this->belongsTo('App\Models\inventario\Material');
    }


    public function distribuidor(){
    	return $this->belongsTo('App\Models\Distribuidor');
    }

    public function fabricante(){
    	return $this->belongsTo('App\Models\Fabricante');
    }


    public function setFechaCompraAttribute($old){
    	$this->attributes['fecha_compra'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function setFechaInstalacionAttribute($old){
    	return $this->attributes['fecha_instalacion'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function setFechaInicioOperacionesAttribute($old){
    	$this->attributes['fecha_inicio_operaciones'] = Carbon::parse($old)->format('Y-m-d');
    }
}