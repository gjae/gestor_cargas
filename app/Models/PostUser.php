<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostUser extends Model
{
    protected $table = 'post_user';
    protected $fillable = [
    	'post_id',
    	'user_id',
    	'edo_reg'
    ];


    public function usuario(){
    	return $this->belongsTo('App\User');
    }

    public function post(){
    	return $this->belongsTo('App\Models\Post');
    }
}
