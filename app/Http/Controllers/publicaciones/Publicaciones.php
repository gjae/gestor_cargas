<?php

namespace App\Http\Controllers\publicaciones;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Categoria;
use App\Models\PostUser;

use App\Models\Post;
use Auth;
use Carbon\Carbon;
use App\Models\Archivo;
class Publicaciones extends Controller
{

    public function index(Request $request){
        $posts = Post::where('posts.edo_reg', 1);

        if($posts){
            $posts = $posts->where('post_user.edo_reg', 1)
                    ->where('post_user.user_id', Auth::user()->id)
                    ->join('post_user', 'post_user.post_id', 'posts.id')
                    ->join('users', 'users.id', 'post_user.user_id')
                    ->select('posts.*');

        }

        if( $request->has('p') && !empty($request->p) )
            $posts = $posts->where('titulo_post', 'LIKE', "%".$request->p."%");
        //return dd( $posts->orderBy('posts.created_at', 'DESC')->paginate(15)[0] );
        return view('modulos.publicaciones.index', [
                'posts' => $posts->orderBy('posts.created_at', 'DESC')->paginate(15)
            ]);
    }

    public function quitar_autorizar($req){
        if(Auth::check() && Auth::user()->tipo_usuario == 'ADMINISTRADOR' ){
            $posts = PostUser::where('post_id', $req->post_id)
                            ->where('user_id', $req->user_id)
                            ->where('edo_reg', 1)
                            ->get();

            foreach ($posts as $key => $post) {
                $post->edo_reg = 0;
                if(! $post->save()){
                    return redirect()
                            ->to( url( 'dashboard/publicaciones/publicaciones/mis_publicaciones' ) )
                            ->with('error', 'ERRPR AL INTENTAR REMOVER EL PERMISO DE VISUALIZACION AL USUARIO');
                    
                }
            }

            return redirect()
                    ->to( url('dashboard/publicaciones/publicaciones/mis_publicaciones') )
                    ->with('correcto', 'SE HA REMOVIDO EL PERMISO AL USUARIO PARA VISUALIZAR LA PUBLICACION');
        }

        return redirect()
                ->to( url('dashboard/publicaciones') )
                ->with('error', 'ERROR: POSIBLEMENTE USTED NO POSEA LOS PERMISOS PARA REALIZAR LA ACCION ELEGIDA');
    }

  public function formulario($req){
        try {
            //return dd($req->all());
            $vista = \View::make('modulos.publicaciones.formularios.'.$req->form, [
                    'id' => $req->id
                ])->render();


            return response([
                    'error' => false,
                    'formulario' => $vista,
                    'action' => url('dashboard/publicaciones/publicaciones/database'),
                ], 200)->header('Content-Type', 'application/json');

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
   }

  public function database($req){
        return call_user_func_array([$this, $req->accion], [$req]);
   }

   private function autorizar($req){
        if(Auth::check() && Auth::user()->tipo_usuario == 'ADMINISTRADOR'){
            $auth = new PostUser($req->all());
            if( $auth->save() ){
                return redirect()
                        ->to( url('dashboard/publicaciones/publicaciones/mis_publicaciones') )
                        ->with('correcto', 'SE HA PROCESADO LA AUTORIZACION SATISFACTORIAMENTE');
            }
            return redirect()
                    ->to( url('dashboard/publicaciones/publicaciones/mis_publicaciones') )
                    ->with('error', 'ERROR AL INTENTAR PROCESAR LA AUTORIZACION');
        }
        return redirect()
                ->to( url('dashboard/publicaciones') )
                ->with('error', 'ERROR: NO POSEE PERMISOS PARA REALIZAR ESTA ACCION');
   }

    public function ver($req, $slug){
    	$post = Post::where('slug', $slug)->first();
    	if($post){

            $autorizado = $post->usuarios_autorizados()
                                ->where('user_id', Auth::user()->id)
                                ->first();

    		if($post->edo_reg == 1){
                
                if( Auth::user()->tipo_usuario == 'ADMINISTRADOR' || $autorizado )
    			     return view('modulos.publicaciones.ver', ['post' => $post]);
                else
                    redirect()
                    ->to( url('dashboard/publicaciones') )
                    ->with('error', 'USTED NO ESTA AUTORIZADO A REVISAR ESTA PUBLICACION');
            }
    		else
    			return redirect()
		    			->to( url('dashboard/publicaciones') )
		    			->with('error', 'ESTA PUBLICACION HA SIDO ELIMINADA O ANULADA, INTENTA CON OTRA');
    	}

    	return redirect()
    			->to( url('dashboard/publicaciones') )
    			->with('error', 'LA PUBLICACION QUE INTENTA VISUALIZAR NO EXISTE O HA SIDO ELIMINADA, INTENTE CON OTRA');
    }

    public function salvar($req){
    	 \DB::beginTransaction();
    	 try {
	    	if(Auth::check() && Auth::user()->tipo_usuario == 'ADMINISTRADOR'){

	    		$post = new Post($req->all());
	    		if($post->save()){
	    			if($req->hasFile('archivo')){
	    				$nombre = '';
	    				foreach($req->file('archivo') as $key => $archivo)
	    				{
	    					$nombre = md5(Carbon::now()->format('Y-m-d h:i:s A'));
		    				$data = [
		    					'extension' => $archivo->getClientOriginalExtension(),
		    					'nombre_original' => $archivo->getClientOriginalName(),
		    					'nombre_archivo' => $nombre,
		    					'ruta' => 'images/uploads/',
		    					'tamano' => $archivo->getClientSize(),
		    					'post_id' => $post->id,
		    					'tipo_archivo' => $archivo->getClientMimeType()
		    				];
		    				$guardar_archivo = new Archivo($data);

		    				if($guardar_archivo->save()){
		    					if(!( $archivo->move('images/uploads', $guardar_archivo->nombre_archivo.'.'.$guardar_archivo->extension) )){
		    						throw new \Exception("ERROR AL PROCESAR EL ARCHIVO", 1);
		    						
		    					}
		    				}
	    				}
	    			}
	    			\DB::commit();
	    			return redirect()
	    				->to( url('dashboard/publicaciones/publicaciones/mis_publicaciones') )
	    				->with('correcto', 'EL REGISTRO SE HA LOGRADO GUARDAR DE MANERA EXITOSA');
	    		}
	    	}
	    	throw new \Exception("USTED NO POSEE LOS PERMISOS NECESARIOS PARA INGRESAR A ESTA URL", 1);
    	 } catch (\Exception $e) {
    	 	\DB::rollback();
    	 	return redirect()
	    			->to( url('dashboard/publicaciones/publicaciones/mis_publicaciones') )
	    			->with('error', 'ERROR: '.$e->getMessage());
    	 }
    }
    public function nueva($req){
    	if( Auth::check() && Auth::user()->tipo_usuario == 'ADMINISTRADOR' ){
    		return view('modulos.publicaciones.crear', [
    				'categorias' => Categoria::where('edo_reg', 1)->get()
    			]);
    	}
    	return redirect()
    			->to( url('dashboard/publicaciones/publicaciones/mis_publicaciones' ) ) 
    			->with('error', 'ERROR: PUEDE QUE USTED NO POSEA PERMISOS PARA REALIZAR ESTA ACCION, VERIFIQUE TAMBIEN QUE SU SESSION EN EL SISTEMA ESTE ACTIVA');
    }

    public function mis_publicaciones($req){

    	if(Auth::user()->tipo_usuario == 'ADMINISTRADOR'){
    		$posts = Post::where('user_id', Auth::user()->id)->where('edo_reg', 1)->orderBy('created_at', 'DESC')->get();
	    	return view('modulos.publicaciones.listar', [
	    			'posts' => $posts
	    		]);
    	}

	    return redirect()
    			->to( url('dashboard/publicaciones') )
    			->with('error', 'USTED NO POSEE LOS PERMISOS NECESARIOS PARA INGRESAR A ESTE APARTADO');
    }

    public function eliminar($req){

    	if(Auth::check() && Auth::user()->tipo_usuario=='ADMINISTRADOR'){
	    	$post = Post::where('id', $req->id)
	    					->where('user_id', Auth::user()->id)->first();

	    	if($post){
		    	$post->edo_reg = 0;
		    	if($post->save()){
		    		return response([
		    				'error' => false,
		    				'mensaje' => 'REGISTRO ELIMINADO SATISFACTORIAMENTE'
		    			], 200)->header('Content-Type', 'application/json');
		    	}
		    }
	    }
	    return response([
	    		'error' => true,
	    		'mensaje' => 'ERROR AL INTENTAR ELIMINAR EL REGISTRO: COMPRUEBE QUE TIENE UNA SECCION ACTIVA EN EL SISTEMA Y DE TENER EL PERMISO PARA ELIMINAR'
	    	], 200)->header('Content-Type', 'application/json');
    }


    public function descargar($req){
    	$post = Post::find($req->publicacion);
    	if($post && $post->edo_reg != 0){
    		$archivo = $post->archivos()->where('id', $req->archivo_id)->first();
    		$headers = [
    			'Content-Type' => $archivo->tipo_archivo,
    		];

    		$ruta = base_path('public/images/uploads/'.$archivo->nombre_archivo.'.'.$archivo->extension);
    		return response()->download($ruta, $archivo->nombre_original, $headers);
    	}
    	return redirect()
    			->to( url('dashboard/publicaciones/publicaciones/ver/'.$post->slug) )
    			->with('error','EL ARCHIVO QUE INTENTA DESCARGAR NO EXISTE, O EL POST HA SIDO RETIRADO');
    }
}
