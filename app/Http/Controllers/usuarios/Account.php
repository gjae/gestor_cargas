<?php

namespace App\Http\Controllers\usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Carbon\Carbon;
use Session;
use Mail;
class Account extends Controller
{
    public function active(Request $req){
    	$user = User::where('active_token', $req->token)->whereNull('actived_at')->first();
    	if($user){
    		Session::flash('correcto', 'Ya casi termina, complete el formulario para continuar');
    		return view('auth.active', [
    				'user' => $user,
    				'token' => $req->token
    			]);
    	}
    	Session::flash('error_user', 'Este usuario ya fue activado');
    	return view('auth.active', [
    				'user' => $user
    			]);
    }

    public function activar(Request $req){
    	$user = User::where('id', $req->user_id)->whereNull('actived_at')->first();

    	if($user){
    		$user->actived_at = Carbon::now()->format('Y-m-d H:i:s');
    		$user->password = $req->password;
    		Session::flash('user_correcto', 'Su usuario ha sido activado satisfactoriamente');
    		if($user->save()){
    			Mail::send('modulos.usuarios.emails.activacion_completa', ['user' => $user], function($m) use($user){
    				$m->from('contacto@cerocsas.com', 'Activacion exitosa');
    				$m->to($user->correo_electronico,' Activacion exitosa')->subject('La activacion se ha realizado exitosamente');
    			});
    			return redirect()
    					->to( url('account/active?token='.$req->token) );
    		}
    	}
    }
}
