<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'archivos';
    protected $fillable = [
    	'nombre_original',
    	'ruta',
    	'tipo_archivo',
    	'nombre_archivo',
    	'tamano',
    	'post_id',
    	'extension'
        'slug'
    ];
    private $extensiones = [
    	'png', 'PNG',
    	'jpg', 'JPG',
    	'jpeg', 'JPEG',
    	'gif', 'GIF',
    	'pdf', 'PDFº'
    ];

    public function post(){

    	return $this->belongsTo('App\Models\Post');
    }

    public function setExtensionAttribute($valor){
    	if(! (in_array($valor, $this->extensiones)) )
    		throw new \Exception("LA EXTENSION ".$valor.' DE UNO DE LOS ARCHIVOS NO ESTA PERMITIDA', 1);

    	$this->attributes['extension'] = $valor;
    		
    }
}
