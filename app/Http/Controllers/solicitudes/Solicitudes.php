<?php

namespace App\Http\Controllers\solicitudes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\Solicitud;
use App\User;
use Mail;

class Solicitudes extends Controller
{
    public function index(){
    	return view('modulos.solicitudes.index', [
    			'solicitudes' => Auth::user()->solicitudes
    		]);
    }

    public function nueva(){
    	return view('modulos.solicitudes.nueva');
    }

    public function guardar($req){
    	$solicitud = new Solicitud($req->all());
    	if($solicitud->save()){
    		$user = Auth::user();
    		$admin = User::where('tipo_usuario', 'ADMIN')
    						->whereNotNull('actived_at')->get();

    		Mail::send('modulos.solicitudes.emails.nueva_solicitud', ['req' => $req, 'admin' => $admin, 'user' => Auth::user(), 'registro' => $solicitud], function($m) use($user, $req, $admin){
    			$m->from('contacto@cerocsas.com', $req->asunto);
    			$m->to($admin[0]->correo_electronico, $req->asunto)->subject($req->asunto);

    			$bccs = [];
    			foreach ($admin as $key => $admin) {
    				array_push($bccs, $admin->correo_electronico);
    			}

    			if($req->copia == 'S'){
    				array_push($bccs, $user->correo_electronico);
    			}
    			$m->bcc($bccs, $req->asunto);

    		});
    		return redirect()
    				->to( url('dashboard/solicitudes/solicitudes') )
    				->with('correcto', 'El registro ha sido guardado de manera exitosa');
    	}else{
    		return redirect()
    				->to( url('dashboard/solicitudes/solicitudes') )
    				->with('error', 'Ha ocurrido un error inesperado al procesar los datos, consulte con su administrador de sistema');
    	}
    }
}
