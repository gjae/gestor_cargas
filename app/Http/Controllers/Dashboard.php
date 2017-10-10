<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
class Dashboard extends Controller
{

	public function index(Request $req, $modulo = null, $programa = null,$accion = null, $slug = null){
		
		$instance = '';

		if(Gate::allows('login-user', Auth::user())){
			if( $modulo == null ){
				return view('index');
			}else{

				$instance = 'App\\Http\\Controllers\\'.$modulo.'\\';
				$programa = ($programa == null) ? ucfirst($modulo) : ucfirst($programa);
				$instance .= $programa;
				$instance = new $instance;
				$accion = ($accion == null )? 'index' : $accion; 
				return call_user_func_array([$instance, $accion], [
					'req' => $req,
					'slug' => $slug
				]);

			}
		}else{
			Auth::logout();
			return redirect()->to( url('login') )->with('error', 'El usuario no ha sido activado');
		}

	}
}
