<?php

namespace App\Http\Controllers\categorias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Auth;
class Categorias extends Controller
{
    public function index($req){
    	return view('modulos.categorias.index', [
    			'categorias' => Categoria::where('edo_reg', 1)->get()
    		]);
    }

  public function formulario($req){
   		try {
   			//return dd($req->all());
   			$vista = \View::make('modulos.categorias.formularios.'.$req->form, [
   					'id' => $req->id
   				])->render();


   			return response([
   					'error' => false,
   					'formulario' => $vista,
   					'action' => url('dashboard/categorias/categorias/database'),
   				], 200)->header('Content-Type', 'application/json');

   		} catch (\Exception $e) {
   			echo $e->getMessage();
   		}
   }

  public function database($req){
   		return call_user_func_array([$this, $req->accion], [$req]);
   }

   private function guardar($req){
   		if(Auth::check() && Auth::user()->tipo_usuario = 'ADMINISTRADOR')
   		{
	   		$categoria = new Categoria($req->all());
	   		if( $categoria->save() ){
	   			return redirect()
	   					->to( url('dashboard/categorias') )
	   					->with('correcto', 'LA CATEGORIA HA SIDO CREADA EXITOSAMENTE');
	   		}
	   	}
   }

   public function eliminar($req){
   		if(Auth::check() && Auth::user()->tipo_usuario == 'ADMINISTRADOR' ){
   			$categoria = Categoria::find($req->id);
   			$categoria->edo_reg = 0;
   			if( $categoria->save() ){
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
	}


	public function editar($req){
		if(Auth::check() && Auth::user()->tipo_usuario == 'ADMINISTRADOR' ){
			$categoria = Categoria::find($req->categoria_id);
			$categoria->nombre_categoria = $req->nombre_categoria;
			$categoria->descripcion_categoria = $req->descripcion_categoria;
			if($categoria->save()){
				return redirect()
						->to( url('dashboard/categorias') )
						->with('correcto', 'LOS DATOS DE LA CATEGORIA FUERON ACTUALIZADOS CORRECTAMENTE');			
			}
			return redirect()
					->to( url('dashboard/categorias') )
					->with('error', 'ERROR AL INTENTAR ACTUALIZAR LOS DATOS DE LA CATEGORIA');	
		}
		return redirect()
				->to(  url('dashboard/categorias') )
				->with('error', 'ERROR: ASEGURESE DE TENER LOS PERMISOS NECESARIOS PARA REALIZAR ESTA ACCION');	
	}

}
