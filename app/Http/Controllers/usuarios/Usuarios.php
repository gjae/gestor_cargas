<?php

namespace App\Http\Controllers\usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Mail;

class Usuarios extends Controller
{
   public function index($req){
   		$users = User::where('edo_reg', 1)->get();
   		return view('modulos.usuarios.index', [
   				'usuarios' => $users
   			]);
   }


   public function formulario($req){
   		try {
   			//return dd($req->all());
   			$vista = \View::make('modulos.usuarios.formularios.'.$req->form, [
   					'id' => $req->id
   				])->render();
   			return response([
   					'error' => false,
   					'formulario' => $vista,
   					'action' => url('dashboard/usuarios/usuarios/crud'),
   				], 200)->header('Content-Type', 'application/json');

   		} catch (\Exception $e) {
   			
   		}
   }


   public function crud($req){
   		return call_user_func_array([$this, $req->accion], [$req]);
   }

   private function guardar($req){
   		$usuario = User::where('email', $req->email)->first();

   		if( $usuario ){
   			return redirect()
   					->to( url('dashboard/usuarios') )
   					->with('error', 'EL NOMBRE DE USUARIO QUE INTENTA INGRESAR YA EXISTE!');
   		}

   		$usuario = new User($req->all());
   		if( $usuario->save() ){
            Mail::send('modulos.usuarios.emails.welcome', ['user' => $usuario], function($mail) use($usuario){
                  $mail->from('contacto@cerocsas.com', 'Activar cuenta en CEROC');
                  $mail->to($usuario->correo_electronico, $usuario->nombre)->subject('Activar cuenta de CEROC');
            });
   			return redirect()
   					->to( url('dashboard/usuarios') )
   					->with('correcto', 'USUARIO CREADO EXITOSAMENTE');
   		}
   		else{
   			
   		}
   }

   private function editar($req){
       $complemento = (Auth::user()->tipo_usuario == 'USUARIO' ) ? '/usuarios/actualizar' :'';
   	if( (Auth::check() && Auth::user()->tipo_usuario == 'ADMINISTRADOR' ) || $req->user_id == Auth::user()->id ){
	   		$user = User::find($req->user_id);

	   		$datos = [];
	   		$user->nombre = $req->nombre;
	   		$user->apellido = $req->apellido;
            if(Auth::user()->tipo_usuario == 'ADMINISTRADOR')
	   		   $user->tipo_usuario = $req->tipo_usuario;

	   		//$datos = $req->except(['_token', 'accion', 'password', 'password2', 'user_id']);
	   		if( !is_null($req->password) )
	   		{
	   			$user->password =  $req->password;
	   		}

	   		//ASI DE FACIL ES ACTUALIZAR
	   		if( $user->save()){
              
	   			return redirect()
   					->to( url('dashboard/usuarios'.$complemento) )
   					->with('correcto', 'LOS DATOS DEL REGISTRO HAN SIDO ACTUALIZADOS CORRECTAMENTE');
	   		}
	   		return redirect()
   					->to( url('dashboard/usuarios'.$complemento) )
   					->with('error', 'ERROR AL INTENTAR ACTUALIZAR LOS DATOS DEL USUARIO');
	   	}
	   	return redirect()
   				->to( url('dashboard/usuarios'.$complemento) )
   				->with('error', 'ERROR: VERIFIQUE QUE POSEE UNA SESSION ABIERTA Y QUE TENGA EL PERMISO CORRECTO PARA ESTA ACCION');
   }


   public function eliminar($req){
   		if(Auth::check() && Auth::user()->tipo_usuario == 'ADMINISTRADOR' ){
   			$user = User::find($req->id);
   			$user->edo_reg = 0;
   			if( $user->save() ){
   				return response([
   						'error' => false,
   						'mensaje' => 'REGISTRO ELIMINADO CORRECTAMENTE'
   					])->header('Content-Type', 'application/json');
   			}
   			return response([
   					'error' => true,
   					'mensaje' => 'ERROR AL INTENTAR ELIMINAR EL REGISTRO, CONSULTE SU ADMINISTRADOR DE SISTEMA'
   				], 200)->header('Content-Type', 'application/json');
   		}

   		return response([
   				'error' => true,
   				'mensaje' =>'ERROR: VERIFIQUE QUE POSEE UNA SESSION ABIERTA Y QUE TENGA EL PERMISO CORRECTO PARA ESTA ACCION'
   			], 200)->header('Content-Type', 'application/json');
   }

   public function actualizar($req){
      return view('modulos.usuarios.actualizar', [
            'user' => Auth::user()
         ]);
   }

   public function logout($req){
      Auth::logout();
      return redirect()
            ->to( url('login') )
            ->with( 'correcto', 'USTED SE HA DESCONECTADO CORRECTAMENTE' );
   }
}
