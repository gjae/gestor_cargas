<?php

namespace App\Http\Middleware;

use Closure;
class CheckUserRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url_array = explode("/", $request->url());
        if( auth()->check() ){
            
            if( count( $url_array ) == 4 && auth()->user()->tipo_usuario == 'USUARIO')
                return redirect()->to( $request->url().'/publicaciones' ); 
        }
        return $next($request);
    }
}
