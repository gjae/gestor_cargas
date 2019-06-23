<?php

namespace App;

// use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tipo_usuario', 'nombre', 'apellido', 'correo_electronico', 'actived_at', 'active_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'actived_at' ,
    ];

    protected $casts = [
        'actived_at' => 'date',
    ];


    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public function categorias(){
        return $this->hasMany('App\Models\Categoria');
    }

    public function getTipoUsuarioAttribute($tipo){
        switch ($tipo) {
            case 'ADMIN':
                return 'ADMINISTRADOR';
                break;
            
            case 'USER':
               return 'USUARIO';
                break;
        }
    }

    public function setPasswordAttribute($viejo){
        $this->attributes['password'] = bcrypt($viejo);
    }

    public function posts_autorizados(){
        return $this->hasMany('App\Models\PostUser');
    }

    public function solicitudes(){
        return $this->hasMany('App\Models\Solicitud');
    }

}
