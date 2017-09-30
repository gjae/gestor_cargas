<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = [
    	'nombre_categoria',
    	'descripcion_categoria',
    	'user_id',
    ];


    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function posts(){
    	return $this->hasMany('App\Models\Post');
    }
}
