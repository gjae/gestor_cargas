<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
	use Sluggable;
    protected $table = "posts";
    protected $fillable = [
    	'titulo_post',
    	'descripcion_post',
    	'edo_reg',
    	'user_id',
    	'categoria_id',
    	'sluged',
    	'slug',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'titulo_post'
            ]
        ];
    }

    public function usuario(){
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function categoria(){
    	return $this->belongsTo('App\Models\Categoria');
    }

    public function archivos(){
    	return $this->hasMany('App\Models\Archivo');
    }

    public function usuarios_autorizados(){
        return $this->hasMany('App\Models\PostUser');
    }
}
